<?php
    class Router{
        public $request;
        public $response;
        protected $routes = [];

        /**
         * @desc constructor
         * @param Request $request
         * @param Response $response
         */
        public function __construct($request, $response){
            $this->request = $request;
            $this->response = $response;
        }


        /**
         * @desc define response for get request
         * @param string $path
         * @param array $callback
         */
        public function get($path, $callback){
            $this->routes['get'][$path] = $callback;
        }


        /**
         * @desc define response for post request
         * @param string $path
         * @param array $callback
         */
        public function post($path, $callback){
            $this->routes['post'][$path] = $callback;
        }


        /**
         * @desc handle request
         * @return mixed response
         */
        public function resolve(){
            $path = $this->request->getPath();
            $method = $this->request->getMethod();
            $callback = $this->routes[$method][$path] ?? $this->routes[$method]['/'];

            if (is_array($callback)){
                Application::$app->controller = new $callback[0]();
                $callback[0] = Application::$app->controller;

                if (get_class($callback[0]) != 'Auth'){

                    if (Application::$app->isGuest()) {
                        Application::$app->response->redirect('/login');
                    }

                }
                else {

                    if (!Application::$app->isGuest()){
                        Application::$app->response->redirect('/profile');
                    }

                }
            }

            return call_user_func($callback, $this->request, $this->response);
        }
    }
?>