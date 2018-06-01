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
      include 'include/header.php';

      if(isset($_SESSION['user'])){
        //This should be !isset and check for userType admin, then kick that motherfucker out if enum!=admin
      }else{
        header('location:login.php');
      }
    ?>
    <div id="main">

      <div id="content" class="w100 flex">

      <div id="sidebar" class="pink"></div>

      <div class="w80">

        <div id="topOfCards" class="block blue">
          <h3>Admin dashboard</h3>
        </div>
        <div id="loadAdminChoice" class="block blue">

        </div>

      </div>
    </div>

    </div>

    <script src="js/main.js"></script>
    <script>
      //var json = <?php echo $json ?>;
      //appendCards('user', json);
    </script>
  </body>
</html>
