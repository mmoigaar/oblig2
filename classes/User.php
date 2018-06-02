<?php
require_once('Func.php');

class User extends Func{

  // Checks if visitor is logged in. Sets cookie no cookie exists.
  public function checkLoginState(){

    // Check if logged in
    if(!isset($_SESSION['user'])){
      // if not logged in, set guest cookie if no cookie exists
      if(!isset($_COOKIE['user'])){
        setcookie('user', 'guest', time()+1000000);
      }
    }else{
      //If logged in, set user cookie if no cookie exists. If guest cookie exists, overwrite.
      if(!isset($_COOKIE['user'])){
        setcookie('user', $_SESSION['user'], time()+1000000);
      }else if($_COOKIE['user'] != $_SESSION['user']){
        $_COOKIE['user'] = $_SESSION['user'];
      }
    }
    //echo $_COOKIE['user'];
  } // End function checkLoginState

  // Stores displayPrefs to whichever was clicked last, if any.
  // This runs if visitor clicked "rand" or "Most Popular"
  public function setDisplayPref($pref){
    // Sets cookie if nonexisting
    if(!isset($_COOKIE['displayPrefs'])){
      setcookie('displayPrefs', $pref, time()+1000000);
    }
    // Changes cookie value
    $_COOKIE['displayPrefs'] = $pref;
  }

  // Checks if cookie value is set
  public function checkDisplayPref(){
    if(isset($_COOKIE['displayPrefs'])){
      return $_COOKIE['displayPrefs'];
    }else{
      return "none";
    }
  } // End function setDisplayPref

  public function login($user, $pass){
    $pdo = $this->pdo;

    $sql = 'SELECT * FROM users WHERE username = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $results = $stmt->fetchAll();

    var_dump($results);
    foreach($results as $result){
      //echo $user->username . '<br>';
      if($result->username == $user && $result->password == $pass){
        session_start();
        $_SESSION['user'] = $user;
        header('location:index.php');
      }
    }
  } // End function login

  public function register($user, $pass, $email){
    $pdo = $this->pdo;

    $sql = 'SELECT * FROM users WHERE username = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $results = $stmt->fetchAll();

    $existing = false;

    foreach($results as $result){
      if($result->username == $user){
        $existing = true;
      }
    }
    if($existing == false){
      echo "I guess you can register with that information.";

      $sql = 'INSERT INTO users(username, password, email, user_type)
              VALUES(?, ?, ?, "basic")';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$user, $pass, $email]);

      //Things below this doesn't run

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

    if(isset($result->title) && $result->title == $title){
      echo "Existing title: ".$result->title;
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

      //var_dump(count($results));
        foreach($results as $result){
          //echo $result->title."<br>";
          if(isset($result) && $result->title == $category){
            $existing = true;
            echo $result->title." already exists <br>";
          }
        }

      // why the fuck doesn't it I N S E R T
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
       WHERE author = "'.$user.'"';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    $json = json_encode($results);
    return $json;

  } // End function listOwnEntries



}

?>
