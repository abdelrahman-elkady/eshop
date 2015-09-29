<?php

class User
{

    public function __construct() {

    }

    /*
     *  Registering a user based on the register form
     */
    public function registerUser()
    {

        if (!(isset($_POST['name']) || isset($_POST['password']) || isset($_POST['form_token']))) {
            $error = 'Something went wrong, go kill yourself!';
        } elseif ($_POST['form_token'] != $_SESSION['form_token']) {
            $error = 'Wait a minute ! hacking something ?! smart ? go kill yourelf :)';
        } else {
            $name = $_POST['name'];
            $password = sha1($_POST['password']);
            $email = $_POST['email'];

            try {
                $stmt = $db->prepare('INSERT INTO `users`(name,password,email) VALUES (:name,:password,:email)');

                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);

                $stmt->execute();

                unset($_SESSION['form_token']);

                $username = $name;

                $body = 'templates/index.tpl.php';
            } catch (Exception $e) {
                echo $e->getCode();
            }
        }
    }
}
