<?php
  require_once('DBConnect.php');

  class Category extends DBConnect{

    public function getCategories(){
      $pdo = $this->pdo;

      $sql =
        'SELECT title
         FROM categories';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $results = $stmt->fetchAll();

      $json = json_encode($results);

      echo $json;

    }

    public function mostPop(){
      $pdo = $this->pdo;

      // Selects resulting entries' categories from category_entries
      $sql =
        'SELECT categoryID
         FROM category_entries
         WHERE submission_date BETWEEN date_sub(NOW(),INTERVAL 1 WEEK) and NOW()';
         // I DECIDED TO DO THIS APPARENTLY, SO BETTER FINISH

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $results = $stmt->fetchAll();

      print_r($results); //remove
      echo "<br><br>";

      if(count($results) == 0){
        echo 'none';
        die;
      }

      $catArray = [];

      // appends category title to array 'catArray' for each occurence
      foreach($results as $cat){
        array_push($catArray, $cat['category']);
      }

      print_r($catArray); //remove
      echo "<br><br>";

      // Counts the number of occurences for each category title
      $catArray = array_count_values($catArray);

      // Sorts resulting array by most occurences
      arsort($catArray);

      // Gets the value of the first element in the array
      $mostPopular = array_slice(array_keys($catArray), 0, 1, true)[0];

      echo $mostPopular;

    }
  }
$category = new Category();
$category->mostPop();
?>
