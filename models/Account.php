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

    // Ham validate ten dang nhap
    public function validateUsername($username) {
        $pattern = '/^[a-zA-Z0-9_]{3,20}$/';                                // Regex cho phép các chữ cái, số và dấu gạch dưới, từ 3 đến 20 ký tự

        if (preg_match($pattern, $username)) {
            return true;                                                    // Username hop le
        } else {
            return false;                                                   // Username khong hop le
        }
    } 

    //Ham validate mat khau
    public function validatePassword($password) {
        $pattern = '/^(?=.*[A-Za-z])(?=.*\d).{3,}$/';                      // Regex co ca chu va so, it nhat 3 ky tu 

        if(preg_match($pattern, $password)) {
            return true;                                                    // Password hop le
        } else {
            return false;                                                   // Password khong hop le
        }
    }

    public function save() {
        $errors = [];

        if (!$this->first_name && !$this->last_name) {
            $errors[] = 'Tên không được để trống';
        }

        if (!$this->validateUsername($this->username)) {
            $errors[] = 'Tên đăng nhập không hợp lệ';
        } 

        if($this->password && $this->re_enter_password === $this->password) {              
            if (!$this->validatePassword($this->password)) {
                $errors[] = 'Mật khẩu phải chứa ít nhất một chữ cái và một số, và có ít nhất 3 ký tự';
            }
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

    public function handleCaptcha($secretKey, $responseKey, $userIP) {
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = file_get_contents($url); 
        $response = json_decode($response);
        if ($response->success) {
            // Xử lý logic khi xác minh thành công 
            return true;
        } else {
            // Xử lý logic khi xác minh thất bại
            return false;
        }
    } 


    public function handleRememberMe($loginDetail) {
        $token = bin2hex(random_bytes(16));                                                 // Tạo token ngẫu nhiên                          
        $this->saveToken($token, $loginDetail);                                             // Luu token vao db                   
        setcookie('remember_token', $token, time() + (7 * 24 * 60 * 60), "/");              // Thiết lập cookie với thời gian sống 7 ngày
    }

}
