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
        if (!(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['form_token']))) {
            $this->errors[] = 'Submitting your request failed, please try again later';

            return false;
        } elseif ($_POST['form_token'] != $_SESSION['form_token']) {
            $this->errors[] = 'Something went wrong, please try again'; // ಠ ּ͜೦
            return false;
        } elseif (strlen($_POST['first_name']) < 2 || strlen($_POST['last_name']) < 2 || strlen($_POST['email']) < 5) {
            $this->errors[] = 'Please make sure you filled in all the required fields';

            return false;
        } elseif (strlen($_POST['password']) < 8) {
            $this->errors[] = 'Please make sure that the password is more than 8 characters';

            return false;
        } elseif ($_POST['password'] != $_POST['password_confirm']) {
            $this->errors[] = 'Password does not match';

            return false;
        } else {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $password = sha1($_POST['password']); // TODO: use more secure hashing mechanism

            if (!empty($_FILES['avatar_file']['name'])) {
                if (!($avatar = $this->uploadAvatar())) {
                    return false;
                }
            }

            try {
                // FIXME: Needs to be refactored !
                if (!empty($_FILES['avatar_file']['name'])) {
                    $stmt = $this->db->prepare('INSERT INTO `users`(first_name,last_name,email,password,avatar) VALUES (:firstName,:lastName,:email,:password,:avatar)');
                    $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
                } else {
                    $stmt = $this->db->prepare('INSERT INTO `users`(first_name,last_name,email,password) VALUES (:firstName,:lastName,:email,:password)');
                }

                $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
                $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);

                $stmt->execute();

                unset($_SESSION['form_token']);

                return true;
            } catch (Exception $e) {
                $this->errors[] = $e->getMessage();

                return false;
            }
        }
    }

    public function loginUser()
    {
        if (!(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['form_token']))) {
            $this->errors[] = 'Submitting your request failed, please try again later';

            return false;
        } elseif ($_POST['form_token'] != $_SESSION['form_token']) {
            $this->errors[] = 'Something went wrong, please try again'; // ಠ ּ͜೦
            return false;
        } elseif (strlen($_POST['email']) < 5) {
            $this->errors[] = 'Please make sure you filled in all the required fields';

            return false;
        } elseif (strlen($_POST['password']) < 8) {
            $this->errors[] = 'Please make sure that the password is more than 8 characters';

            return false;
        } else {
            $email = $_POST['email'];
            $password = sha1($_POST['password']); // TODO: use more secure hashing mechanism


        try {
            $stmt = $this->db->prepare('SELECT user_id,first_name,last_name,email,password,avatar FROM `users` WHERE email = :email AND password = :password');

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_BOTH);

            $id = $data[0];
            $firstName = $data[1];
            $lastName = $data[2];
            $email = $data[3];
            $pass = $data[4];
            $avatar = $data[5];

            if ($id == false) {
                $this->errors[] = 'Authentication failed, please check your username or password';

                return false;
            } else {
                unset($_SESSION['form_token']);
                $_SESSION['user']['id'] = $id;
                $_SESSION['user']['first_name'] = $firstName;
                $_SESSION['user']['last_name'] = $lastName;
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['pass'] = $pass;
                $_SESSION['user']['avatar'] = $avatar;

                return true;
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();

            return false;
        }
        }
    }

    public function updateUserProfile(){
        
        $this->updateField('first_name', $_POST['first_name'], 2);
        $this->updateField('last_name', $_POST['last_name'], 2);
        $this->updateField('email', $_POST['email'], 5);

    }

    public function updateField($key ,$value ,$min_len){

        if($value != $_SESSION['user'][$key]) {
        
            if(strlen($value) < $min_len){
            
                $this->errors[] = 'Please make sure the $key field is greater than $min_len';
            
            } else {
            
                #TODO UPDATE THE FIELD IN DB
            
            }

        }
    }
    
    public function isSignedIn()
    {
        return isset($_SESSION['user']['id']);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function uploadAvatar()
    {
        $target_dir = 'assets/images/avatars/';
        $target_file = $target_dir.basename($_FILES['avatar_file']['name']);

        if (isset($_POST['submit'])) {
            $check = getimagesize($_FILES['avatar_file']['tmp_name']);
            if ($check == false) {
                $this->errors[] = 'File uploaded is not a proper image format';

                return false;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $this->errors[] = 'This file already exists !';

            return false;
        }

        if (!(move_uploaded_file($_FILES['avatar_file']['tmp_name'], $target_file))) {
            $this->errors[] = 'Failed to upload your avatar, please try again';

            return false;
        }

        return $target_file;
    }
}
