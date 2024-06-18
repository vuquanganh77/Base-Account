<?php

namespace app\controllers;

use app\Router;
use app\models\Account;

class UserController {
    public function index(Router $router) {
        session_start();
        $userData = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'username' => '',
            'job_title' => '',
            'phone_number' => '',
            'address' => '',
            'profile_image' => '',
            'dob' => '',
            'date' => '',
            'month' => '',
            'year' => '',
        ];

        if (isset($_SESSION['user'])) {
            
            $id = $_SESSION['user'];
            $account = new Account();
            $queryResult = $account->userDetail($id);
            $userData['first_name'] = $queryResult['first_name'];
            $userData['last_name'] = $queryResult['last_name'];
            $userData['email'] = $queryResult['email'];
            $userData['username'] = $queryResult['username'];
            $userData['job_title'] = $queryResult['job_title'];
            $userData['phone_number'] = $queryResult['phone_number'];
            $userData['address'] = $queryResult['address'];
            $userData['profile_image'] = $queryResult['profile_image'];
            $userData['dob'] = $queryResult['dob'];
            //var_dump($queryResult);
            // tach ngay, thang, nam   
            
            if($userData['dob']){   
                $dateParts = explode('-',  $userData['dob']);
                // Lấy các giá trị từ mảng
                $userData['date'] = $dateParts[0];    
                $userData['month'] = $dateParts[1];   
                $userData['year'] = $dateParts[2];    
            }

            $router->renderView('users/index', [
                'userData' => $userData,
            ]);
        } else {
            header('Location: /');
        }
    }

    public function update(Router $router) {
        $account = new Account();
        session_start();
        $errors = [];
        $userData = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'username' => '',
            'job_title' => '',
            'phone_number' => '',
            'address' => '',
            'profile_image' => '',
            'dob' => ''
        ];
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['user'];
            $user = $account->userDetail($id);                                                  // Lấy thông tin user
            $image_temp = $user['profile_image'];                                               // Lưu đường dẫn ảnh cũ nếu có
            $imagePath = '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userData['first_name'] = $_POST['first_name'];
                $userData['last_name'] = $_POST['last_name'];
                $userData['job_title'] = $_POST['job_title'];
                $userData['phone_number'] = $_POST['phone_number'];
                $userData['address'] = $_POST['address'];
                $userData['dob'] = $_POST['date-dropdown'] . '-' . $_POST['month-dropdown'] . '-' . $_POST['year-dropdown'];
                $image = $_FILES['profile_image'] ?? null;

                $random = $account->randomString(8);

                if ($image['name']) {
                    $imagePath = 'images/' . $random . '/' . $image['name'];
                    mkdir(dirname($imagePath));
                    move_uploaded_file($image['tmp_name'], $imagePath);
                    $userData['profile_image'] = $imagePath;
                    rmdir(dirname($image_temp));                                                // Xóa thư mục chứa ảnh cũ
                }else{
                    $userData['profile_image'] = $image_temp;
                }
            }
            $account->load($userData);
            $account->saveEdit();
        }
        // $router->renderView('users/update');
        header('Location: /user');
    }
}
