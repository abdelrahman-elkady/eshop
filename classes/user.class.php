<?php

class User
{
    private $db;
    private $errors;

    public function __construct($db)
    {
        $this->db = $db;
        $this->errors = array();
    }

    /*
     *  Registering a user based on the register form
     */
    public function registerUser()
    {
        if (!(isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['avatar_file']) || isset($_POST['form_token']))) {
            $this->errors[] = 'Submitting your request failed, please fill in all your information';
        } elseif ($_POST['form_token'] != $_SESSION['form_token']) {
            $this->errors[] = 'Something went wrong, please try again'; // ಠ ּ͜೦
        } else {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $password = sha1($_POST['password']); // TODO: use more secure hashing mechanism
            $avatar = $this->uploadAvatar();

            try {
                $stmt = $this->db->prepare('INSERT INTO `users`(first_name,last_name,email,password,avatar) VALUES (:firstName,:lastName,:email,:password,:avatar)');

                $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
                $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);

                $stmt->execute();

                unset($_SESSION['form_token']);

                Utils::redirect('index.php');
            } catch (Exception $e) {
                $this->errors[] = $e->getMessage();
            }
        }
    }

    private function uploadAvatar()
    {
        $target_dir = 'assets/images/avatars';
        $target_file = $target_dir.basename($_FILES['avatar_file']['name']);

        if (isset($_POST['submit'])) {
            $check = getimagesize($_FILES['avatar_file']['tmp_name']);
            if ($check == false) {
                $this->errors[] = 'File uploaded is not a proper image format';
                Utils::redirect('index.php');
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $this->errors[] = 'This file already exists !';
            Utils::redirect('index.php');
        }

        if (!(move_uploaded_file($_FILES['avatar_file']['tmp_name'], $target_file))) {
            {
          $this->errors[] = 'Something went wrong !, please try again later';
          Utils::redirect('index.php');
        }
        }

        return $target_file;
    }
}
