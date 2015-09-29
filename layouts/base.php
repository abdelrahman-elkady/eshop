<?php
  include_once('config/config.php');
  session_start();
?>

<!DOCTYPE html>
<html>

  <?php include_once('includes/header.php'); ?>

  <body>

    <!-- Content -->
    <?php include_once $body ?>
    <!-- /Content -->

    <script type="text/javascript">
      <? php include_once $bottom_scripts ?>
    </script>

  </body>
</html>
