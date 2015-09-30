<?php
  $form_token = md5(uniqid('auth', true));
  $_SESSION['form_token'] = $form_token;
?>

<form action="index.php" method="post" role="form">

  <legend>Create a new account</legend>
  <div class="form-group">
    <label for="first-name">First Name</label>
    <input type="text" class="form-control" id="first-name" placeholder="Someone">
  </div>
  <div class="form-group">
    <label for="last-name">Last Name</label>
    <input type="text" class="form-control" id="last-name" placeholder="Someone Else">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" placeholder="someone@somewhere.com">
  </div>
  <div class="form-group">
    <label for="password">Email</label>
    <input type="password" class="form-control" id="password" placeholder="•••••••">
  </div>

  <div class="form-group">
    <label for="avatar-file-upload">Avatar</label>
    <input type="file" id="avatar-file-upload">
  </div>

  <input type="hidden" name="form_token" value="<?php echo $form_token; ?>">

  <button type="submit" class="btn btn-primary">Register</button>

</form>
