<header class="pink">
  <h1 class="inline">Urbski Mc. D</h1>
  <div id="navItems" class="inline">
    <a href="index.php" class="inline"><h2>Home</h2></a>
    <div class="dropdown">
      <img src="icons/user.png" class="icon inline">
        <div class="dropdown-content">
          <p>
            <?php
              if(isset($_SESSION['user'])){
                echo 'Logged in as: '.$_SESSION['user'];
              }else{
                echo 'Visiting as Guest';
              }
            ?>
          </p>
          <?php
          if(isset($_SESSION['user'])){
            echo '
              <form method="post">
                <button id="dashboard" name="dashboard" type="submit">Dashboard</button>
                <button id="logout" name="logout" type="submit">Log out</button>
              </form>
              ';
            if(isset($_POST['logout'])){
              session_destroy();
              header('location:index.php');
            }
            if(isset($_POST['dashboard'])){
              header('location:user.php');
            }
          }else{
            echo '
            <form method="post">
              <button id="login" name="login" value="Log in">Log in</button>
            </form>
            ';
            if(isset($_POST['login'])){
              header('location:login.php');
            }
          }
          ?>
        </div>
    </div>
  </div>
</header>
