<?php
include_once 'config/config.php';

class Utils
{

    // TODO: Check for adding some 'back-redirection'
    public function redirect($url,$fullPath = false)
    {
        if(!($fullPath)) {
          $url = HOSTNAME . $url;
        }
        header('Location: ' . $url);
        die();
    }
}
