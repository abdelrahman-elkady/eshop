<?php
  $form_token = md5(uniqid('auth', true));
  $_SESSION['form_token'] = $form_token;
?>

<form action="register.php" method="post" role="form" enctype="multipart/form-data" >

  <legend>Create a new account</legend>
  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Someone">
  </div>
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Someone Else">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="someone@somewhere.com">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="•••••••">
  </div>

  <div class="form-group">
    <label for="avatar_file">Avatar</label>
    <input type="file" name="avatar_file" id="avatar_file">
  </div>

  <input type="hidden" name="form_token" value="<?php echo $form_token; ?>">

  <button type="submit" class="btn btn-primary">Register</button>

</form>
