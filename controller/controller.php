<?php
require_once('../classes/Category.php');
require_once('../classes/Entry.php');
require_once('../classes/User.php');

$category = new Category();
$entry = new Entry();
$user = new User();

if(isset($_POST['action'])) {
  $action = $_POST['action'];
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
  }
}



?>
