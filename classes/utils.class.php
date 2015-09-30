<?php
include_once 'config/config.php';

class Utils
{
    public function redirect($url,$fullPath = false)
    {
        if(!($fullPath)) {
          $url = HOSTNAME . $url;
        }
        header('Location: ' . $url);
        die();
    }
}
