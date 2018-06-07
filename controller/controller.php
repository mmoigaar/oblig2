<?php
require_once('../classes/Category.php');
require_once('../classes/Entry.php');
require_once('../classes/User.php');

$category = new Category();
$entry = new Entry();
$user = new User();
session_start();

if(isset($_POST['action'])) {
  $action = $_POST['action'];
  $userID = $_SESSION['user'];
  switch($action) {
    case 'getCategories':
      $category->getCategories();
      break;
    case 'mostPop':
      $category->mostPop();
      break;
    case 'getEntries':
      $entry->getEntries();
      break;
    case 'checkDisplayPref':
      $user->checkDisplayPref();
      break;
    case 'setDisplayPref':
      $pref = $_POST['pref'];
      echo $pref;
      $user->setDisplayPref($pref);
      break;
    case 'getOwnEntries':
      $user->getOwnEntries($_SESSION['user']);
      break;
    case 'deleteEntry':
      $entry->deleteEntry($_POST['del']);
      break;
  }
}



?>
