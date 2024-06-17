<?php

namespace app\controllers;

use app\Router;
use app\models\Account;

class AuthenticationController {
    
    public function login(Router $router) {
        $config = include '../config/config.php';
        $errors = [];
        $is_captcha_display = false;
        session_start();                                                                        // Khởi tạo session
        $account = new Account();                                                               // Khai báo đối tượng model Account

        if (!isset($_SESSION['user']) && isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];                                                // Lấy token từ cookie
            // Tìm người dùng với token này trong database
            $user = $account->getUserByToken($token);                                           // $statement->fetch(PDO::FETCH_ASSOC

            if ($user) {
                $_SESSION['user'] = $user['id'];                                                // Nếu tìm thấy người dùng, khôi phục session
            } else {
                setcookie('remember_token', '', time() - 3600, '/');                            // Xóa cookie nếu token không hợp lệ
            }
        }

        if (isset($_SESSION['user'])) {
            header('Location: /user');                                                          // Nếu đã đăng nhập, chuyển hướng đến trang user
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$_POST['email']) {
                $errors[] = 'Chưa nhập email';                                                  // Kiểm tra xem đã nhập email chưa
            }

            if (!$_POST['password']) {
                $errors[] = 'Chưa nhập mật khẩu';                                               // Kiểm tra xem đã nhập password chưa
            }

            $loginDetail = $account->login($_POST['email'], $_POST['password']);

            if ($loginDetail === "Mật khẩu sai") {
                if (isset($_SESSION['count_login_err'])) {
                    $_SESSION['count_login_err']++;
                } else {
                    $_SESSION['count_login_err'] = 1;
                }
            }

            if (is_int($loginDetail)) {
                //session_start();

                if (isset($_SESSION['count_login_err']) && $_SESSION['count_login_err'] >= 3) {
                    $secretKey = $config['recaptcha_secret_key'];
                    $responseKey = $_POST['g-recaptcha-response'];
                    $userIP = $_SERVER['REMOTE_ADDR'];

                    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
                    $response = file_get_contents($url);
                    $response = json_decode($response);
                    if ($response->success) {
                        // Xử lý logic khi xác minh thành công
                        $_SESSION['count_login_err'] = 0;

                        if (isset($_POST['saved']) && $_POST['saved'] === 'on') {                       // Kiểm tra xem checkbox "Remember Me" có được chọn không
                            $token = bin2hex(random_bytes(16));                                         // Tạo token ngẫu nhiên                          
                            $account->saveToken($token, $loginDetail);                                  // Luu token vao db                   
                            setcookie('remember_token', $token, time() + (7 * 24 * 60 * 60), "/");      // Thiết lập cookie với thời gian sống 7 ngày
                        }

                        $_SESSION['user'] = $loginDetail;
                        header('Location: /user');
                    } else {
                        // Xử lý logic khi xác minh thất bại
                        $errors = ['Xử lý CAPTCHA không thành công'];
                    }
                }else{
                    if (isset($_POST['saved']) && $_POST['saved'] === 'on') {                       // Kiểm tra xem checkbox "Remember Me" có được chọn không
                        $token = bin2hex(random_bytes(16));                                         // Tạo token ngẫu nhiên                          
                        $account->saveToken($token, $loginDetail);                                  // Luu token vao db                   
                        setcookie('remember_token', $token, time() + (7 * 24 * 60 * 60), "/");      // Thiết lập cookie với thời gian sống 7 ngày
                    }
    
                    $_SESSION['user'] = $loginDetail;
                    header('Location: /user');
                }            
            } else {
                $errors[] = $loginDetail;                                                       // Lưu lỗi
            }
        }

        if (isset($_SESSION['count_login_err']) && $_SESSION['count_login_err'] >= 3) {
            $is_captcha_display = true;
        }

        $router->renderView('authentication/index', [
            'errors' => $errors,
            'is_captcha_display' => $is_captcha_display,
            'recaptcha_site_key' => $config['recaptcha_site_key'],
        ]);
    }

    public function signup(Router $router)
    {
        $errors = [];
        $accountData = [
            'name' => '',
            'username' => '',
            'email' => '',
            'password' => '',
            're_enter_password' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $nameParts = explode(' ', $name);                                                   // tach chuoi thanh mang
            $accountData['last_name'] = array_shift($nameParts);                                // lay phan tu dau tien cua mang
            $accountData['first_name'] = implode(' ', $nameParts);                              // noi cac phan tu con lai lai thanh chuoi

            $accountData['username'] = $_POST['username'];
            $accountData['email'] = $_POST['email'];
            $accountData['password'] = $_POST['password'];
            $accountData['re_enter_password'] = $_POST['re_enter_password'];

            $account = new Account();
            $account->load($accountData);
            $errors = $account->save();
            if (empty($errors)) {
                header('Location: /');
            }
        }

        $router->renderView('authentication/signup', [
            'account' => $accountData,
            'errors' => $errors,
        ]);
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user']);                                                               // Xóa $_SESSION['user']
        setcookie('remember_token', '', time() - (7 * 24 * 60 * 60), '/');                      // Xóa cookie
        // session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }

    public function forgetPassword(Router $router)
    {
        $errors = [];
        $notices = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $account = new Account();
            $user = $account->getUserByEmail($email);
            if ($user) {
                $name = $user['last_name'] . " " . $user['first_name'];
                $token = bin2hex(random_bytes(3));
                $account->saveMailToken($token, $user['id']);
                $account->send_mail($name, $email, $token);
            } else {
                $errors[] = 'Email không tồn tại';
            }
            if (empty($errors)) {
                header('Location: /forget_password?status=success');
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['status']) && $_GET['status'] === 'success') {
                $notices[] = 'Đã gửi mail thành công, vui lòng kiểm tra mail của bạn để đổi mật khẩu';
            }
        }

        $router->renderView('authentication/forget_password', [
            'errors' => $errors,
            'notices' => $notices,
        ]);
    }

    public function resetPassword(Router $router)
    {
        $errors = [];
        $notices = [];
        //$token = '';
        $account = new Account();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!($_POST['password']) || !($_POST['re_enter_password'])) {
                $errors[] = 'Chưa nhập mật khẩu';
            }

            if ($_POST['password'] !== $_POST['re_enter_password']) {
                $errors[] = 'Mật khẩu không khớp';
            }

            $password = $_POST['password'];
            $re_enter_password = $_POST['re_enter_password'];
            if ($password === $re_enter_password && $_POST['password']) {
                session_start();
                $token = $_SESSION['token'];
                $user = $account->getUserByMailToken($token);
                if ($user) {
                    $account->updatePassword($user['id'], $password);
                    $notices = ['Đổi mật khẩu thành công'];
                    //header('Location: /');
                }
            }
        }
        $router->renderView('authentication/reset_password', [
            'errors' => $errors,
            'notices' => $notices,
        ]);
    }
}
