<?php
    spl_autoload_register(function ($classname){
        $folders =  ['core', 'core/form', 'core/database', 'core/model', 'core/dialog', 'controllers', 'models', 'entities'];
        foreach ($folders as $folder){
            $direct = __DIR__ . '/../' . $folder . '/' . strtolower($classname) . '.php';
            if (file_exists($direct)) require_once $direct;
        }
    });

    $config = [
            'db' => [
                    'dsn' => 'mysql:localhost;port=3306;dbname=true_account',
                    'user' => 'root',
                    'password' => '',
            ]
    ];

    $app = new Application(dirname(__DIR__), $config);
    $app->router->get('/', [Site::class, 'home']);
    $app->router->get('/profile', [Site::class, 'getProfile']);
    $app->router->post('/profile', [Site::class, 'updateProfile']);
    $app->router->post('/profile/avatar', [Site::class, 'updateAvatar']);
    $app->router->post('/profile/change-password', [Site::class, 'changePassword']);
    $app->router->get('/login', [Auth::class, 'login']);
    $app->router->post('/login', [Auth::class, 'login']);
    $app->router->get('/register', [Auth::class, 'register']);
    $app->router->post('/register', [Auth::class, 'register']);
    $app->router->get('/logout', [Site::class, 'logout']);
    $app->run();
?>