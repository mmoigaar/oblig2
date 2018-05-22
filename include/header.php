<header>
  <h1 class="inline">Urbski Mc. D</h1>
  <div id="navItems" class="inline">
    <a class="inline"><h2>Home</h2></a>
    <div class="dropdown">
      <img src="icons/user.png" class="icon inline">
      <?php
        include_once 'functions.php';
        func::checkLoginState();
      ?>
    </div>
  </div>
</header>
