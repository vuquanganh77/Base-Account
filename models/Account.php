<?php

namespace app\models;

use app\Database;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class Account {
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $email = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $re_enter_password = null;
    public ?string $job_title = null;
    public ?string $phone_number = null;
    public ?string $address = null;
    public ?string $profile_image = null;
    public ?string $dob = null;


    public function load($data) {
        $this->first_name = $data['first_name'] ?? null;
        $this->last_name = $data['last_name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->re_enter_password = $data['re_enter_password'] ?? null;
        $this->job_title = $data['job_title'] ?? null;
        $this->phone_number = $data['phone_number'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->profile_image = $data['profile_image'] ?? null;
        $this->dob = $data['dob'] ?? null;
    }

    public function save() {
        $errors = [];

        if (!$this->first_name && !$this->last_name) {
            $errors[] = 'Tên không được để trống';
        }

        if (!$this->password || !$this->re_enter_password) {
            $errors[] = 'Mật khẩu không được để trống';
        }

        if (!$this->email) {
            $errors[] = 'Email không được để trống';
        }

        if ($this->password !== $this->re_enter_password) {
            $errors[] = 'Mật khẩu không khớp';
        }

        // Check mail ton tai hay chua
        $emailExists = $this->getUserByEmail($this->email);
        if ($emailExists) {
            $errors[] = 'Email đã tồn tại';
        }

        // validate email 
        if ($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Địa chỉ email không hợp lệ.";
        }

        if (empty($errors)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);     // Hash pw truoc khi luu vao db
            $db = Database::$db;  // truy cap thuoc tinh static
            $db->createAccount($this);
        }

        return $errors;
    }

    public function login($username, $password) {
        $db = Database::$db;                                           // truy cap thuoc tinh static
        return $db->loginAccount($username, $password);
    }

    public function userDetail($id) {
        $db = Database::$db;
        return $db->getUserById($id);
    }

    public function saveEdit() {
        $errors = [];

        if (!$this->first_name) {
            $errors[] = 'Tên không được để trống';
        }

        if (!$this->last_name) {
            $errors[] = 'Họ không được để trống';
        }

        //if(empty($errors)) {
        $db = Database::$db;
        $db->updateUser($this, $_SESSION['user']);
        //}

        //return $errors;
    }

    public function randomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }
        return $str;
    }

    public function saveToken($token, $id) {
        $db = Database::$db;
        $db->saveTokentoDb($token, $id);
    }

    public function getUserByToken($token) {
        $db = Database::$db;
        return $db->getUserByToken($token);
    }

    public function getUserByEmail($email) {
        $db = Database::$db;
        return $db->getUserByEmail($email);
    }

    public function saveMailToken($token, $id) {
        $db = Database::$db;
        $db->saveMailTokentoDb($token, $id);
    }

    public function send_mail($name, $get_mail, $token) {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'localhost';                                  // Cau hinh mailhog                       
            $mail->Port = 1025;
            $mail->setFrom('example@gmail.com', $name);
            $mail->addAddress($get_mail);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Notification';

            $mail_template = "
                <h2>Hi $name</h2>
                <h3>You are receiving this email because we received a password reset request for your account.</h3>
                <br></br>
                <a href='http://localhost:8080/reset_password?token=$token'>Reset Password</a>
            ";

            //Content
            $mail->Body = $mail_template;
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } 

    public function getUserByMailToken($token) {
        $db = Database::$db;
        return $db->getUserByMailToken($token);
    } 

    public function updatePassword($id, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $db = Database::$db;
        $db->updatePassword($id, $password);
    }

    public function updateCountLogin($email) {
        $db = Database::$db;
        $db->updateCountLogin($email);
    } 

}
