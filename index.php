<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  </head>
  <body>
    <?php
      session_start();
      include 'functions.php';
      func::checkLoginState();
      include 'include/header.php';
    ?>
    <div id="main" class="flex">
      <div id="content" class="w100">
        <div id="search" class="w100 blue">
          <h1>No idea if you're logged in, yo. Check icon.</h1>
        </div>
        <div id="container" class="w100">

          <?php
            $categories = ['cat1', 'cat2', 'cat3'];
            func::getEntries($categories);
          ?>
          <div id="entryCard" class="block orange">
            <h3 class="title block w100">qweqweqweqweqwe</h3>
            <div class="entryContent flex">
              <div class="left w45 pink">
                <article class="description block h50">
                  <p>qweeeeeeeeeeeeeeeeeeeeeeeeeeeeeee</p>
                </article>
                <article class="context block h50 blue">
                  <p><i>Q W E</i></p>
                </article>
              </div>
              <div class="right w45 blue">
                <div class="entryInfo block h50 pink">
                  <div class="likes w45 block"></div>
                  <div class="categories w45 block"></div>
                </div>
                <div class="submitInfo w45">
                  <p class="submissionDate"></p>
                  <p class="submittedBy"></p>
                </div>
              </div>
            </div>
          </div>

          <div id="entryCard" class="block orange">
            <h3 class="title block w100">Saying orqqqqqqqqq whatever</h3>
            <div class="entryContent flex">
              <div class="left w45 pink">
                <article class="description block h50"></article>
                <article class="context block h50 blue"></article>
              </div>
              <div class="right w45 blue">
                <div class="entryInfo block h50 pink">
                  <div class="likes w45 block"></div>
                  <div class="categories w45 block"></div>
                </div>
                <div class="submitInfo w45">
                  <p class="submissionDate"></p>
                  <p class="submittedBy"></p>
                </div>
              </div>
            </div>
          </div>

          <div id="entryCard" class="block orange">
            <h3 class="title block w100">Saying orqqqqqqqqq whatever</h3>
            <div class="entryContent flex">
              <div class="left w45 pink">
                <article class="description block h50"></article>
                <article class="context block h50 blue"></article>
              </div>
              <div class="right w45 blue">
                <div class="entryInfo block h50 pink">
                  <div class="likes w45 block"></div>
                  <div class="categories w45 block"></div>
                </div>
                <div class="submitInfo w45">
                  <p class="submissionDate"></p>
                  <p class="submittedBy"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="sidebar" class="pink">
        <!-- No idea what goes here yet-->
      </div>
    </div>
  </body>
</html>
