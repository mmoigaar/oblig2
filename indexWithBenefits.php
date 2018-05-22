<html>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>
    <?php session_start(); ?>
    <header>
      <h1>Urbski Mc. D</h1>
      <div>
        <a class="inline"><p>Home</p></a>
        <a class="inline"><p>Log in</p></a>
        <a class="inline"><p>Register</p></a>
      </div>
    </header>

    <div id="main" class="flex">
      <div id="content" class="w100">
        <div id="search" class="w100 blue">
          <h1>Visiting as: <?php echo $_SESSION['user']; ?></h1>
        </div>
        <div id="container" class="w100">

          <div id="entryCard" class="block orange">
            <h3 class="title block w100">Saucin'</h3>
            <div class="entryContent flex">
              <div class="left w45 pink">
                <article class="description block h50">
                  <p>Stems from Gucci Mane's interview. Appended to by Post Malone.</p>
                </article>
                <article class="context block h50 blue">
                  <p><i>I'm saucin' on you.</i></p>
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
