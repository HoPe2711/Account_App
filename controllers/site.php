<?php
    class Site extends Controller{
        public $profile;

        /**
         * @desc constructor
         */
        public function __construct(){
            $this->profile = new Profile(Application::$app->user);
        }


        /**
         * @desc handle invalid url
         * @param Request $request
         * @param Response $response
         */
        public function home($request, $response){
            $response->redirect('/profile');
        }


        /**
         * @desc render profile page
         * @param Request $request
         * @param Response $response
         * @return string html
         */
        public function getProfile($request, $response){
            return $this->render('profile', ['model' => $this->profile]);
        }


        /**
         * @desc edit only profile avatar
         * @param Request $request
         * @param Response $response
         */
        public function updateAvatar($request, $response){
            $this->profile->updateAvatar($request);
            $response->redirect('/profile');
        }


        /**
         * @desc edit profile information
         * @param Request $request
         * @param Response $response
         */
        public function updateProfile($request, $response){
            $this->profile->updateProfile($request);
            $response->redirect('/profile');
        }


        /**
         * @desc handle change password request
         * @param Request $request
         * @param Response $response
         * @return string message;
         */
        public function changePassword($request, $response){
            return $this->profile->changePassword($request);
        }


        /**
         * @desc handle logout request
         * @param Request $request
         * @param Response $response
         */
        public function logout($request, $response){
            Application::$app->logout();
            $response->redirect('/');
        }
    }
?>