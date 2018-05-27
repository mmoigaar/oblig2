<?php

class func{

  // Checks if visitor is logged in. Sets cookie no cookie exists.
  public static function checkLoginState(){

    /*
      TO DO:
      * Figure out how to increase cookie lifespan on each login
    */


    // Check if logged in
    if(!isset($_SESSION['user'])){
      // if not logged in, set guest cookie if no cookie exists
      if(!isset($_COOKIE['user'])){
        setcookie('user', 'guest', time()+25);
        $_COOKIE['displayPrefs'] = [];
      }
    }else{
      //If logged in, set user cookie if no cookie exists. If guest cookie exists, overwrite.
      if(!isset($_COOKIE['user'])){
        setcookie('user', $_SESSION['user'], time()+25);
        $_COOKIE['displayPrefs'] = [];
      }else if($_COOKIE['user'] != $_SESSION['user']){
        $_COOKIE['user'] = $_SESSION['user'];
      }
    }
    //echo $_COOKIE['user'];
  }

  // Database connection. Call this for every function where SQL queries are required.
  public static function connectToDB(){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'urban_dictionary';

    // Set DSN
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $pdo;
  }

  public static function login($user, $pass){
    $pdo = func::connectToDB();

    $sql = 'SELECT * FROM users WHERE username = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $results = $stmt->fetchAll();

    var_dump($results);
    foreach($results as $result){
      //echo $user->username . '<br>';
      if($result->username == $user && $result->password == $pass){
        $_SESSION['user'] = $user;
        header('location:index.php');
      }
    }
  }

  public static function register($user, $pass, $email){
    $pdo = func::connectToDB();

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
  }
  // This first inserts entry, then categories, then category_entry

  // Alternatively I can do some object relational mapping if I cba learning it
  public static function submit($title, $author, $content, $context, $categories){
    $pdo = func::connectToDB();

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

  public static function getCategories(){
    $pdo = func::connectToDB();

    $sql =
      'SELECT title
       FROM categories';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($results);
    return $json;


  }


  /*
  // Gets unique entries if they match one or more categories in an array.
  public static function getEntries($categories){
    $pdo = func::connectToDB();

    $sql =
      'SELECT DISTINCT entry
       FROM category_entries
       WHERE category = ';

    if(count($categories) > 1){

      $sql .= '"'.$categories[0].'"';

      for($i = 1; $i < count($categories); $i++){
        $sql .= ' OR category = "'.$categories[$i].'"';
      }
    }else{
      $sql .= '"'.$categories.'"';
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql =
      'SELECT DISTINCT title, content, context
       FROM entries
       WHERE title = "'.$results[0]['entry'].'"';

    if(count($results) > 1){
      for($i = 1; $i < count($results); $i++){
        $sql .= ' OR entries.title = "'.$results[$i]['entry'].'"';
      }
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($results);
    //echo $json;
    // I'm a fucking god
    return $json;
  } // End function getEntries
  */

  // Gets unique entries and adds "classes" index with all relevant classes for each entry. Returns final result as JSON data.
  public static function getEntries(){
    $pdo = func::connectToDB();

    $sql =
      'SELECT *
       FROM category_entries';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $ca_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql =
      'SELECT DISTINCT title, content, context
       FROM entries';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $entry_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    for($i=0; $i < count($entry_results); $i++){

      $entry_results[$i]['classes'] = array();

      foreach($ca_results as $caRow){
        if($entry_results[$i]['title'] == $caRow['entry']){
        $entry_results[$i]['classes'][] = $caRow['category'];
        }
      }
    }
    $json = json_encode($entry_results);

    return $json;
  } // End function getEntries

  public static function listOwnEntries($user){
    $pdo = func::connectToDB();

    $sql =
      'SELECT *
       FROM entries
       WHERE author = "'.$user.'"';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


  } // End function listOwnEntries
}

?>
