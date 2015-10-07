<?php

class User
{
    private $db;
    private $errors;
    private $history;

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
                $_SESSION['user']['password'] = $pass;
                $_SESSION['user']['avatar'] = $avatar;

                return true;
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();

            return false;
        }
        }
    }

    public function updateUserProfile()
    {
        $old_password = sha1($_POST['old_password']);

        if ($old_password != $_SESSION['user']['password']) {
            $this->errors[] = 'Wrong Password';

            return false;
        }
        $fields = array();

        $this->addToFields('first_name', $_POST['first_name'], 2, $fields);
        $this->addToFields('last_name', $_POST['last_name'], 2, $fields);
        $this->addToFields('email', $_POST['email'], 5, $fields);

        #Avatar
        if (!empty($_FILES['avatar_file']['name'])) {
            if (($avatar = $this->uploadAvatar())) {
                $this->addToFields('avatar', $avatar, 0, $fields);
            }
        }

        #Password
        if (strlen($_POST['new_password']) < 8) {
            $this->errors[] = 'Please make sure that the new password is more than 8 characters';
        } elseif ($_POST['new_password'] != $_POST['confirm_password']) {
            $this->errors[] = 'Password does not match';
        } else {
            $this->addToFields('password', sha1($_POST['new_password']), 0, $fields);
        }

        if (count($fields) > 0) {
            #Something to update
            $query = 'UPDATE `users` SET ';
            $i = 0;
            $comma = '';
            foreach ($fields as $key => $value) {
                $_SESSION['user'][$key] = $value;
                $query .= $comma.'`'.$key.'` = :p'.$i;
                $comma = ', ';
                $i = $i + 1;
            }
            $id = $_SESSION['user']['id'];
            $query .= ' WHERE `users`.`user_id` = '.$id;

            try {
                $stmt = $this->db->prepare($query);

                $i = 0;

                foreach ($fields as $key => $value) {
                    $stmt->bindValue(':p'.$i, $value, PDO::PARAM_STR);
                    $i = $i + 1;
                }
                $stmt->execute();
            } catch (Exception $e) {
                $this->errors[] = $e->getMessage();

                return false;
            }
        }

        return true;
    }

    public function addToFields($key, $value, $min_len, &$fields)
    {
        if ($value != $_SESSION['user'][$key]) {
            if (strlen($value) < $min_len) {
                $this->errors[] = 'Please make sure the $key field is greater than $min_len';

                return false;
            } else {
                $fields[$key] = $value;

                return true;
            }
        }

        return true;
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

            return $target_file;
        }

        if (!(move_uploaded_file($_FILES['avatar_file']['tmp_name'], $target_file))) {
            $this->errors[] = 'Failed to upload your avatar, please try again';

            return false;
        }

        return $target_file;
    }

    public function getHistory()
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM `purchases` , `products` WHERE `purchases`.`user_id` = :id AND `purchases`.`product_id` = `products`.`product_id`');

            $stmt->bindParam(':id', intval($_SESSION['user']['id']), PDO::PARAM_INT);
            $stmt->execute();
            $history = $stmt->fetchAll();

            return $history;
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();

            return false;
        }
    }
}
