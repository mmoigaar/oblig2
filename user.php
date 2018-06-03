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
      session_start();
      include 'classes/User.php';
      include 'include/header.php';
      include 'include/userCards.php';

      if(isset($_SESSION['user'])){
        $user = new User();
        $json = $user->listOwnEntries($_SESSION['user']);
      }else{
        header('location:login.php');
      }
    ?>
    <div id="main" class="flex">

      <div id="content" class="w100">
        <div id="cardContainer" class="w100">
          <div id="topOfCards" class="block blue w80">
            <h3>Your entries</h3>
          </div>
        </div>

        </div>
      </div>

    </div>

    <script src="js/main.js"> // This runs document ready functions, which includes listing random entries. Can't have that, yo. Make JS files for each files.</script>
  </body>
</html>
