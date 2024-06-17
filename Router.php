<?php

namespace app;

class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;   // Tao 1 instance cua Database class

    public function __construct(){
        $this->db = new Database();
    }

    public function get($url,$fn){
        $this->getRoutes[$url] = $fn;
    }

    public function post($url,$fn){
        $this->postRoutes[$url] = $fn;
    }

    public function resolve(){
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET'){
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        // echo "<pre>";
        // var_dump($fn);
        // echo "</pre>";

        if($fn){
            call_user_func($fn, $this);
        } else {
            echo "Page not found";
        }
    }

    public function renderView($view, $params = []){
        foreach($params as $key => $value){
            $$key = $value;                     // $$key la 1 bien co ten la gia tri cua $key
        }
        include_once __DIR__ . "/views/$view.php";
    }

}


