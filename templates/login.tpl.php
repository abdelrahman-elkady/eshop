<?php
$form_token = md5(uniqid('auth', true));
$_SESSION['form_token'] = $form_token;
?>

<form action="login.php" method="post" role="form">

	<legend>Login to your account</legend>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" id="email" placeholder="someone@somewhere.com">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" name="password" class="form-control" id="password" placeholder="•••••••">
	</div>

	<input type="hidden" name="form_token" value="<?php echo $form_token; ?>">

	<button type="submit" class="btn btn-primary">Login</button>


</form>

<p>Not a member ? - <a href="register.php">Register now</a></p>