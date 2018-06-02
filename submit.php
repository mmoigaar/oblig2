<html>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>
    <?php
      session_start();
      include "include/header.php";
    ?>

    <div id="main">
      <form method="post" class="entryForm">

        <label>Title</label>
        <input type="text" name="title" placeholder="Entry title" class="entryInput">

        <label>Description</label>
        <textarea name="description" placeholder="Description" class="entryDescription entryInput"></textarea>

        <label>Context</label>
        <input type="text" name="context" placeholder="Context/use in a sentence" class="entryInput">

        <label>Categories</label>
        <input type="text" name="categories" placeholder="celeb, sayings, rap, pop culture" class="entryInput">

        <input type="submit" name="submit" class="entryInput">
      </form>
    </div>

    <?php
      if(isset($_POST['submit'])){

        $title = htmlentities($_POST['title']);
        $author = $_SESSION['user'];
        $description = htmlentities($_POST['description']);
        $context = htmlentities($_POST['context']);
        $categories = str_getcsv(htmlentities($_POST['categories']));

        include_once 'functions.php';
        Entry::submit($title, $author, $description, $context, $categories);
      }
    ?>
  </body>
</html>
