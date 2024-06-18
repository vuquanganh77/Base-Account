<?php

namespace app;

use app\models\Account;
use PDO;

class Database {
    public \PDO $pdo;
    public static Database $db;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;port=3306;dbname=true', 'root', '');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    } 

    public function test() {
        $statement = $this->pdo->prepare('SELECT * FROM users');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAccount(Account $account) {
        $statement = $this->pdo->prepare('INSERT INTO users (first_name, last_name, email, username, password) VALUES (:first_name, :last_name, :email, :username, :password)');
        $statement->bindValue(':first_name', $account->first_name);
        $statement->bindValue(':last_name', $account->last_name);
        $statement->bindValue(':email', $account->email);
        $statement->bindValue(':username', $account->username);
        $statement->bindValue(':password', $account->password);
        $statement->execute();
    } 

    public function loginAccount($email, $password) {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $account = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$account) {
            return "Không tồn tại tài khoản với username này";
        }

        if(password_verify($password, $account['password'])) {
            return $account['id'];
        }

        return "Mật khẩu sai";
    }


    public function getUserById($id) {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    } 

    public function updateUser(Account $account, string $id) {
        $statement = $this->pdo->prepare('UPDATE users SET first_name = :first_name, last_name = :last_name, job_title = :job_title, phone_number = :phone_number, address = :address, profile_image = :profile_image, dob = :dob WHERE id = :id');
        $statement->bindValue(':first_name', $account->first_name);
        $statement->bindValue(':last_name', $account->last_name);
        $statement->bindValue(':job_title', $account->job_title);
        $statement->bindValue(':phone_number', $account->phone_number);
        $statement->bindValue(':address', $account->address);
        $statement->bindValue(':profile_image', $account->profile_image);
        $statement->bindValue(':dob', $account->dob);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public function getUserByToken($token) {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE remember_token = :token');
        $statement->bindValue(':token', $token);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    } 

    public function saveTokentoDb($token, $id) {
        $statement = $this->pdo->prepare('UPDATE users SET remember_token = :token WHERE id = :id');
        $statement->bindValue(':token', $token);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public function saveMailTokentoDb($token, $id) {
        $statement = $this->pdo->prepare('UPDATE users SET mail_code = :token WHERE id = :id');
        $statement->bindValue(':token', $token);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public function getUserByEmail($email) {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByMailToken($token) {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE mail_code = :token');
        $statement->bindValue(':token', $token);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    } 

    public function updatePassword($id, $password) {
        $statement = $this->pdo->prepare('UPDATE users SET password = :password WHERE id = :id');
        $statement->bindValue(':password', $password);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public function updateCountLogin($email) {
        $statement = $this->pdo->prepare('UPDATE users SET count_login_err = count_login_err + 1 WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
    }

}