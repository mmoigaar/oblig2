<html>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>
    <?php
      session_start();
      include 'include/header.php';
    ?>

    <div id="main" class="flex">
      <div id="register">
        <h2>Register a new account!</h2>
        <form method="post">
          <input type="text" name="newUser" placeholder="username"><br>
          <input type="text" name="newPass" placeholder="password"><br>
          <input type="text" name="email" placeholder="qwe@qwe.qwe"><br>
          <input type="submit" name="register" value="register">
        </form>
      </div>
      <div id="existingUser">
        <h2>Already a user? Log in!</h2>
        <form method="post">
          <input type="text" name="existingUser" placeholder="username"><br>
          <input type="text" name="existingPass" placeholder="password"><br>
          <input type="submit" name="login" value="login">
        </form>
      </div>
    </div>

    <?php

      //CREATE PDO OBJECT IN CLASS INSTEAD
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $dbname = 'urban_dictionary';

      // Set DSN
      $dsn = 'mysql:host='.$host.';dbname='.$dbname;

      // Create a PDO instance
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

      if(isset($_POST['login'])){
        $login_user = htmlentities($_POST['existingUser']);
        $login_pass = htmlentities($_POST['existingPass']);

        include_once 'functions.php';
        func::login($login_user, $login_pass, $pdo);
      }

      if(isset($_POST['register'])){
        $new_user = htmlentities($_POST['newUser']);
        $new_pass = htmlentities($_POST['newPass']);
        $email = htmlentities($_POST['email']);

        include_once 'functions.php';
        func::register($new_user, $new_pass, $email, $pdo);
      }
  ?>
  </body>
</html>
