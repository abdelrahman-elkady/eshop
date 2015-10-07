<div class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="index.php">Eshop</a>
    </div>
    <div class="navbar-collapse collapse">

      <ul class="nav navbar-nav navbar-left">
        <?php if ($userObj->isSignedIn()): ?>
          <li><a href="cart.php">Shopping Cart</a></li>
          <li><a href="history.php">Purchase history</a></li>
        <?php endif; ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php if ($userObj->isSignedIn()): ?>

          <p class="navbar-text">Welcome, <span id="nav-link"><a href="profile.php"><?php echo $_SESSION['user']['first_name']; ?></span></a></p>

          <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
      <!-- /.navbar-right -->

    </div>
    <!--/.nav-collapse -->
  </div>
</div>
