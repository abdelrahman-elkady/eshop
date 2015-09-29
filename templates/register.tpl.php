<?php
  $form_token = md5(uniqid('auth', true));
  $_SESSION['form_token'] = $form_token;
?>

<form action="index.php" method="post">
  <label for="name">Name</label>
  <input type="text" name="name" value="">
  <br>
  <label for="password">Password</label>
  <input type="password" name="password" value="">
  <br>
  <label for="email">Email</label>
  <input type="text" name="email" value="">

  <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">

  <input type="submit" value="Register">
</form>
