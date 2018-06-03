<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
  </head>
  <body>
    <?php
      include 'classes/User.php';
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
        if(!empty($_POST['existingUser']) && !empty($_POST['existingPass'])){
          $login_user = htmlentities($_POST['existingUser']);
          $login_pass = htmlentities($_POST['existingPass']);
          $user = new User();
          $user->login($login_user, $login_pass);
        }else{
          echo 'input missing';
        }
      }

      if(isset($_POST['register'])){
        if(!empty($_POST['newUser']) && !empty($_POST['newPass']) && !empty($_POST['email'])){
          $new_user = htmlentities($_POST['newUser']);
          $new_pass = htmlentities($_POST['newPass']);
          $email = htmlentities($_POST['email']);
          $user = new User();
          $user->register($new_user, $new_pass, $email);
        }else{
          echo 'input missing';
        }
      }
  ?>
  </body>
</html>
