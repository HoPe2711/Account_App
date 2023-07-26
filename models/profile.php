<?php
    class Profile{
        public $user;

        /**
         * @desc constructor
         * @param User $user
         */
        public function __construct($user){
            $this->user = $user;
        }


        /**
         * @desc save and get dir file
         * @param string $id
         * @return string|null
         */
        private function uploadFile($id){
            if ($_FILES[$id]['name'] != ""){
                $target_dir = "../public/image/";
                $file = $_FILES[$id]['name'];
                $path = pathinfo($file);
                $filename = $path['filename'].uniqid();;
                $ext = $path['extension'];
                $temp_name = $_FILES[$id]['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;
                move_uploaded_file($temp_name,$path_filename_ext);
                return $filename.".".$ext;
            }
            return null;
        }


        /**
         * @desc edit only profile avatar
         * @param Request $request
         */
        public function updateAvatar($request){
            $query = $request->getBody();
            $upload_file = self::uploadFile('profile_image');

            if ($upload_file != null){
                $query['profile_image'] = $upload_file;
            }

            $user_id = Application::$app->session->get('user');
            User::updateOne($query, $user_id);
        }


        /**
         * @desc edit profile information
         * @param Request $request
         */
        public function updateProfile($request){
            $query = $request->getBody();
            foreach ($query as $key=>$value){

                if ($value == null){
                    unset($query[$key]);
                }

            }

            if (checkdate($query['dob_month'], $query['dob_day'], $query['dob_year'])){
                $query['birthday'] = $query['dob_day'] . '/' . $query['dob_month'] . '/' . $query['dob_year'];
            }

            unset($query['dob_day'], $query['dob_month'], $query['dob_year']);

            $upload_file = self::uploadFile('profile_image');

            if ($upload_file != null){
                $query['profile_image'] = $upload_file;
            }

            $user_id = Application::$app->session->get('user');
            User::updateOne($query, $user_id);
        }


        /**
         * @desc handle change password request
         * @param Request $request
         * @return string message;
         */
        public function changePassword($request){
            $query = $request->getBody();

            if (!password_verify($query['current_password'], $this->user->password)){
                return 'Password is incorrect';
            }

            if ((strlen($query["new_password"]) < 8) || (strlen($query["new_password"]) > 24)){
                return 'New password must have 8-24 characters';
            }

            if (($query["new_password"] != $query["retype_new_password"]) || ($query["new_password"] == '')){
                return 'Retype new password must be the same as new password';
            }

            $user_id = Application::$app->session->get('user');
            User::updateOne(['password' => password_hash($query['new_password'], PASSWORD_DEFAULT)], $user_id);

            if ($query['force_logout'] == 1){
                Application::$app->logout();
                return 'login';
            }
            else{
                return 'profile';
            }
        }
    }
?>