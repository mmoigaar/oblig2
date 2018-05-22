<?php

class func{

  public static function checkLoginState(){
    if(!isset($_SESSION['user'])){
      include 'include/guestDropdown.php';
      if(!isset($_COOKIE['user'])){
        setcookie('user', 'guest', time()+25);
        $_COOKIE['displayPrefs'] = [];
      }
    } else{
      include 'include/userDropdown.php';
    }
    /*
    else{
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $dbname = 'urban_dictionary';

      // Set DSN
      $dsn = 'mysql:host='.$host.';dbname='.$dbname;

      // Create a PDO instance
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

      $sql = 'SELECT * FROM users';

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $results = $stmt->fetchAll();

      switch($_SESSION['user']){

      }

    }
      */
  }

  public static function login($user, $pass, $pdo){
    $sql = 'SELECT * FROM users WHERE username = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    //var_dump($results);
    foreach($results as $result){
      //echo $user->username . '<br>';
      if($result->username == $user && $result->password == $pass){
        session_start();
        $_SESSION['user'] = $user;

        header('location:index.php');
      }
    }
  }

  public static function register($user, $pass, $email, $pdo){
    $sql = 'SELECT * FROM users WHERE username = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

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
  }
  // This first inserts entry, then categories, then category_entry

  // Alternatively I can do some object relational mapping if I cba learning it
  public static function submit($title, $author, $content, $context, $categories){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'urban_dictionary';

    // Set DSN
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


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

    var_dump($categories);

    foreach($categories as $category){
      foreach($results as $result){
        echo $result->title."<br>";
        if(isset($result) && $result->title == $category){
          $existing = true;
          echo $result->title." already exists <br>";
        }
      }
      if($existing == false){
        $sql = 'INSERT INTO categories(title)
                VALUES(?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category]);
      }
      $existing = false;
    }

    // Category_entry things
  }

}

?>
