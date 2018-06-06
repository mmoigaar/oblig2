<?php
require_once('DBConnect.php');
class User extends DBConnect{

  // Stores displayPref for logged in user to whichever was clicked last, if any.
  // This runs if visitor clicked "rand" or "Most Popular"
  public function setDisplayPref($pref){

    session_start();
    if(isset($_SESSION['user'])){
      // Sets unique cookie name for each logged in user
      $cookieName = "displayPref_" . $_SESSION['user'];
    }else{
      // Sets default cookie name for guest users
      $cookieName = "displayPref";
    }

    // Checks if cookie exists and unsets if it does
    if(isset($_COOKIE[$cookieName])){
      unset($_COOKIE[$cookieName]);
      setcookie($cookieName, null, -1, '/');
    }
    // Sets cookie with display preference as value
    setcookie($cookieName, $pref, time()+1000000, '/');
    $_COOKIE[$cookieName] = $pref;
  }

  // Checks if cookie value is set
  public function checkDisplayPref(){
    session_start();
    if(isset($_SESSION['user'])){
      $cookieName = "displayPref_" . $_SESSION['user'];
    }else{
      $cookieName = "displayPref";
    }

    if(isset($_COOKIE[$cookieName])){
      echo $_COOKIE[$cookieName];
    }else{
      echo "none";
    }
  } // End function setDisplayPref

  public function login($user, $pass){
    $pdo = $this->pdo;

    $sql = 'SELECT * FROM users WHERE username = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $result = $stmt->fetch();

    if($result['username'] == $user && $result['password'] == $pass){
      session_start();
      $_SESSION['user'] = $user;
      header('location:index.php');
    }

  } // End function login

  public function register($user, $pass, $email){
    $pdo = $this->pdo;

    $sql = 'SELECT * FROM users WHERE username = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $result = $stmt->fetch();

    $existing = false;

    if($result['username'] == $user){
      $existing = true;
    }

    if($existing == false){
      $sql = 'INSERT INTO users(username, password, email, user_type)
              VALUES(?, ?, ?, "basic")';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$user, $pass, $email]);

      session_start();
      $_SESSION['user'] = $user;
      header('location:index.php');
    }else{
      echo "Username already exists, probably";
    }
  } // End function register

  // This first inserts entry, then categories, then category_entry

  // Alternatively I can do some object relational mapping if I cba learning it
  public function submit($title, $author, $content, $context, $categories){
    $pdo = $this->pdo;

    // Entry insert things
    $sql = 'SELECT * FROM entries WHERE title = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title]);
    $result = $stmt->fetch();

    if(!empty($result['title']) && $result['title'] == $title){
      echo "Existing title: ".$result['title'];
      die;
    }
    else{
      $sql = 'INSERT INTO entries(title, author, submission_date, context, content)
              VALUES(?, ?, NOW(), ?, ?)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$title, $author, $context, $content]);

      echo "Inserted entry probably <br>";
    }

    // Category insert things
    $sql = 'SELECT * FROM categories';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $existing = false;

    //var_dump($categories);

    foreach($categories as $category){

      foreach($results as $result){
        if(isset($result) && $result['title'] == $category){
          $existing = true;
          echo $result['title']." already exists <br>";
        }
      }

      if($existing == false){
        $sql = 'INSERT INTO categories(title, author)
                VALUES(?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category, $author]);
      }
      $existing = false;

      // Category_entry things
      $sql = 'INSERT INTO category_entries(category, entry)
              VALUES(?, ?)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$category, $title]);
    }
  }

  public function listOwnEntries($user){
    $pdo = $this->pdo;

    $sql =
      'SELECT *
       FROM entries
       WHERE author = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $results = $stmt->fetchAll();

    $json = json_encode($results);
    return $json;

  } // End function listOwnEntries



}

?>
