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
      include 'functions.php';
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

      if(isset($_POST['login'])){
        $login_user = htmlentities($_POST['existingUser']);
        $login_pass = htmlentities($_POST['existingPass']);

        include_once 'functions.php';
        func::login($login_user, $login_pass);
      }

      if(isset($_POST['register'])){
        $new_user = htmlentities($_POST['newUser']);
        $new_pass = htmlentities($_POST['newPass']);
        $email = htmlentities($_POST['email']);

        include_once 'functions.php';
        func::register($new_user, $new_pass, $email);
      }
  ?>
  </body>
</html>
