<?php

class func{

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
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  }
}

?>
