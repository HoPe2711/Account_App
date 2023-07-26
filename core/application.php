<?php
    class Application{
        public static $ROOT_DIR;
        public $router;
        public $request;
        public $response;
        public $mysql;
        public static $app;
        public $controller;
        public $session;
        public $user;

        /**
         * @desc constructor
         * @param string $rootPath
         * @param array $config
         */
        public function __construct($rootPath, $config){
            self::$ROOT_DIR = $rootPath;
            self::$app = $this;
            $this->user = null;
            $this->request = new Request();
            $this->response = new Response();
            $this->router = new Router($this->request, $this->response);
            $this->mysql = new Mysql($config);
            $this->session = new Session();
            $user_id = Application::$app->session->get('user');

            if ($user_id){
                $key = User::primaryKey();
                $this->user = User::findOne([$key => $user_id]);
            }
        }


        /**
         * @desc handle requests
         */
        public function run(){
            echo $this->router->resolve();
        }


        /**
         * set session user for login
         * @param User $user
         * @return true
         */
        public function login($user){
            $this->user = $user;
            $className = get_class($user);
            $primaryKey = $className::primaryKey();
            $value = $user->{$primaryKey};
            Application::$app->session->set('user', $value);
            return true;
        }


        /**
         * @desc remove session user
         */
        public function logout(){
            $this->user = null;
            self::$app->session->remove('user');
        }


        /**
         * @desc check user
         * @return bool
         */
        public function isGuest(){
            return !self::$app->user;
        }
    }
?>