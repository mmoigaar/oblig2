<?php
require_once('Func.php');

class Entry extends Func{

  // Gets unique entries and adds "classes" index with all relevant classes for each entry. Returns final result as JSON data.
  public function getEntries(){
    $pdo = $this->pdo;

    $sql =
      'SELECT *
       FROM category_entries';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $ca_results = $stmt->fetchAll();

    $sql =
      'SELECT DISTINCT title, content, context
       FROM entries';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $entry_results = $stmt->fetchAll();

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

}


?>
