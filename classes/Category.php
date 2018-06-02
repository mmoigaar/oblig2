<?php
  require_once('Func.php');

  class Category extends Func{

    public function getCategories(){
      $pdo = $this->pdo;

      $sql =
        'SELECT title
         FROM categories';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $results = $stmt->fetchAll();

      $json = json_encode($results);

      return $json;

    }

    public function mostPop(){
      $pdo = $this->pdo;

      // Selects title of entries from the past week
      $sql =
        'SELECT title
         FROM entries
         WHERE submission_date BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now()';

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_NUM);

      // Selects resulting entries' categories from category_entries
      $sql =
        'SELECT category
         FROM category_entries
         WHERE entry = '.'"'.$results[0][0].'"';

      if(count($results) > 1){
        for($i = 1; $i < count($results); $i++){
          $sql .= ' OR entry = "'.$results[$i][0].'"';
        }
      }

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $results = $stmt->fetchAll();

      $catArray = [];
      // appends category title to array 'catArray' for each occurence
      foreach($results as $cat){
        array_push($catArray, $cat['category']);
      }

      // Counts the number of occurences for each category title
      $catArray = array_count_values($catArray);

      // Sorts resulting array by most occurences
      arsort($catArray);

      // Gets the value of the first element in the array
      $mostPopular = array_slice(array_keys($catArray), 0, 1, true)[0];

      return $mostPopular;

    }

    // Admin only: deletes category and all rows from other tables which reference that category
    public function deleteCategory($category){
      $pdo = $this->pdo;
      /*
      $sql =
        'DELETE *
         FROM entries
         WHERE title = "'.$category.'"';
      */ // Add "ON DELETE CASCADE" to all tables referencing category
      $stmt = $pdo->prepare($sql);
      $stmt->execute();

    } // End function deleteCategory

  }

?>
