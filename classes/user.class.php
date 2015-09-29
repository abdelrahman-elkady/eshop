<?php

class User
{

    private $db;
    private $errors;

    function __construct($db) {
      $this->db = $db;
      $this->errors = array();
    }

    /*
     *  Registering a user based on the register form
     */
    public function registerUser()
    {

        if (!(isset($_POST['name']) || isset($_POST['password']) || isset($_POST['form_token']))) {
            $this->errors[] = 'Submitting your request failed, please fill in all your information';
        } elseif ($_POST['form_token'] != $_SESSION['form_token']) {
            $this->errors[] = 'Something went wrong, please try again'; // ಠ ּ͜೦
        } else {

            // TODO: Modify based on the new user schema

            $name = $_POST['name'];
            $password = sha1($_POST['password']);
            $email = $_POST['email'];

            try {
                $stmt = $this->db->prepare('INSERT INTO `users`(name,password,email) VALUES (:name,:password,:email)');

                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);

                $stmt->execute();

                unset($_SESSION['form_token']);

                $username = $name;

                $body = 'templates/index.tpl.php'; // FIXME should redirect better ?
            } catch (Exception $e) {
                $this->errors[] = $e->getMessage();
            }

        }
    }
}
