<?php
    class Auth extends Controller{
        /**
         * @desc handle login post request and render login page
         * @param Request $request
         * @param Response $response
         * @return string html
         */
        public function login($request, $response){
            $login = new Login();

            if ($request->isPost()){

                if ($login->solve($request)){
                    $response->redirect('/profile');
                }

            }

            return $this->render('login', ['model' => $login]);
        }


        /**
         * @desc handle register post request and render register page
         * @param Request $request
         * @param Response $response
         * @return string html
         */
        public function register($request, $response){
            $register = new Register();

            if ($request->isPost()){

                if ($register->solve($request)) {
                    $response->redirect('/login');
                }

            }

            return $this->render('register', ['model' => $register]);
        }
    }
?>