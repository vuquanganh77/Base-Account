<?php 

    require_once __DIR__ . '/../vendor/autoload.php';
    use app\controllers\UserController;
    use app\controllers\AuthenticationController;
    use app\Router;


    $router = new Router();

    $router->get('/', [new AuthenticationController, 'login']);
    $router->post('/', [new AuthenticationController, 'login']);
    $router->get('/signup', [new AuthenticationController, 'signup']);
    $router->post('/signup', [new AuthenticationController, 'signup']);
    $router->get('/user', [new UserController, 'index']);
    $router->post('/user/update', [new UserController, 'update']);
    $router->get('/user/logout', [new AuthenticationController, 'logout']);
    $router->get('/forget_password', [new AuthenticationController, 'forgetPassword']);
    $router->post('/forget_password', [new AuthenticationController, 'forgetPassword']);
    $router->get('/reset_password', [new AuthenticationController, 'resetPassword']); 
    $router->post('/reset_password', [new AuthenticationController, 'resetPassword']);

    $router->resolve();
