<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!--
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  -->
  </head>
  <body>
    <?php
      session_start();
      include 'functions.php';
      func::checkLoginState();
      include 'include/header.php';

      $categoryJSON = func::getCategories();
      $cardJSON = func::getEntries();
    ?>

    <div id="main" class="flex">

      <div id="sidebar" class="pink">
        <div id="categoriesContainer">
          <h2>Categories</h2>
          <hr/>
          <div class="category" onclick="displayChoice('showAll')">
            <h3 class="blue">Show all</h3>
          </div>
        </div>
      </div>

      <div id="content" class="w100">
        <div id="search" class="w100 blue">
          <h1>No idea if you're logged in, yo. Check icon.</h1>
        </div>

        <div id="cardContainer" class="w100"></div>

      </div>

    </div>

    <!-- Templates ---------------------------------------------------->

    <div id="categoryTemplate" class="category categoryItem">
      <h3 class="blue"></h3>
    </div>

    <div id="cardTemplate" class="entryCard block orange">
      <h3 class="title block w100"></h3>
      <div class="entryContent flex">
        <div class="left w45 pink description block h50">
            <p class="descPar"></p>
        </div>
        <div class="right w45 blue">
          <article class="context block h50 blue">
            <p><i class="contextPar"></i></p>
          </article>
            <div class="categories h50 block pink">
              <h4>Categories</h4>
              <p></p>
            </div>
        </div>
      </div>
    </div>

    <p id="pTemplate"></p>


    <script src="js/main.js"></script>
    <script>
      var categoryJSON = <?php echo $categoryJSON ?>;
      var cardJSON = <?php echo $cardJSON ?>;
      appendCategories(categoryJSON);
      appendCards(cardJSON);
    </script>
    <script src="js/main.js"></script>
  </body>
</html>
