<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="shortcut icon" href="">
  </head>
  <body>
    <?php
      session_start();
      include 'classes/User.php';

      $user = new User();
      $user->checkLoginState();

      include 'include/header.php';
      include 'include/cardTemplates.php';


    ?>

    <div id="main">

      <div id="content" class="w100 flex">

        <div id="sidebar" class="pink">
          <?php
            if(isset($_SESSION['user'])){
              echo '
              <form method="post">
                <button id="submit" name="submit" type="submit">Submit entry</button>
              </form>
              ';
              if(isset($_POST['submit'])){
                header('location:submit.php');
              }
            }
          ?>
          <div id="categoriesContainer">

            <h2>Categories</h2>
            <hr/>

            <div class="category blue" onclick="displayChoice('All')">
              <h3>Show all</h3>
            </div>

            <!-- This has to be form submitted name='rand'-->
            <div class="category blue" onclick="displayChoice('rand')">
              <h3>Random</h3>
            </div>

            <!-- This has to be form submitted name='mostPop'-->
            <div id="mostPop" class="orange">
              <h3>Most popular this week:</h3>
            </div>

          </div>
        </div>

        <div id="cardContainer" class="w100">
          <div id="topOfCards" class="block blue w80">
            <h3></h3>
          </div>
        </div>

      </div>

    </div>

    <!-- Templates ---------------------------------------------------->

    <div id="categoryTemplate" class="category categoryItem blue">
      <h3></h3>
    </div>


    <p id="pTemplate"></p>

    <?php

      // Runs functions if user clicks either 'Random' or whatever's listed in 'Most popular'
      /*
      if(isset($_POST['rand'])){
        $user->setDisplayPref('rand');
      }else if(isset($_POST['mostPop'])){
        $user->setDisplayPref('mostPop');
      }
*/
    ?>

    <script src="js/main.js"></script>
  </body>
</html>
