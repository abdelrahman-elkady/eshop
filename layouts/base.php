<?php
  include_once('config/config.php');
  session_start();
?>

<!DOCTYPE html>
<html>

  <?php include_once('includes/header.php'); ?>

  <body>

    <!-- Error Handling -->
    <div class="error">
      <?php foreach($errors as $error): ?>
        <div class="error-message">
          <p>
            <?php echo $error ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
    <!-- /Error Handling -->

    <!-- Content -->
    <?php include_once $body ?>
    <!-- /Content -->

    <?php include_once 'includes/scripts.php'; ?>

    <!-- FIXME: need to include this as a dynamic one ?! -->
    <script type="text/javascript">
      <? php include_once $bottom_scripts ?>
    </script>

  </body>
</html>
