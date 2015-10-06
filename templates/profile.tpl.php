<div id="profile">

  <div class="centered">
    <h3><?php echo $_SESSION['user']['first_name']; ?>'s profile</h3>

    <div id="profile_avatar" class="circular-image" style="background-image:url('<?php echo $_SESSION['user']['avatar'];?>')">
      <div class="overlay"><i class='fa fa-upload'></i></div>
    </div>

  </div>

  <form action="profile.php" method="post" role="form" enctype="multipart/form-data" id="update-profile-form">

    <div class="form-group">
      <label for="first_name">First Name</label>
      <input type="text" class="form-control" name="first_name" value="<?php echo $_SESSION['user']['first_name']; ?>">
    </div>

    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input type="text" class="form-control" name="last_name" value="<?php echo $_SESSION['user']['last_name']; ?>">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
    </div>

    <div class="form-group">
      <label for="old_password">Old Password</label>
      <input type="password" class="form-control" name="old_password" placeholder="•••••••">
    </div>

    <div class="form-group">
      <label for="new_password">New Password</label>
      <input type="password" class="form-control" name="new_password" placeholder="•••••••">
    </div>

    <div class="form-group">
      <label for="confirm_password">New Password</label>
      <input type="password" class="form-control" name="confirm_password" placeholder="•••••••">
    </div>

    <input id="avatar_file" name="avatar_file" class="hidden" type="file">

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="index.php" class="btn btn-danger">Cancel</a>

  </form>

</div>
