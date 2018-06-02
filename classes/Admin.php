<?php
require_once('Func.php');

class Admin extends Func{

  // Admin only: deletes category and all rows from other tables which reference that category
  public function deleteCategory($category){
    $pdo = func::connectToDB();
    /*
    $sql =
      'DELETE *
       FROM entries
       WHERE title = "'.$category.'"';
    // Add "ON DELETE CASCADE" to all tables referencing category
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    */
  } // End function deleteCategory

  // Admin only: deletes user and all rows from other tables which reference that user
  public function deleteUser($user){
    $pdo = func::connectToDB();

    /*
    $sql =
      'DELETE *
       FROM users
       WHERE username = "'.$user.'"';
    */ // Add "ON DELETE CASCADE" to all tables referencing user
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

  } // End function deleteUser

}

?>
