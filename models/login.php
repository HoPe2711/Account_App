<?php
    class Login extends Authentication{
        public $email = '';
        public $password = '';

        /**
         * @desc define rules for login input
         * @return array
         */
        public function rules(){
            return [
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
                'password' => [self::RULE_REQUIRED],
            ];
        }


        /**
         * @desc define labels for login input
         * @return array
         */
        public function labels(){
            return [
                'email' => 'Email',
                'password' => 'Password'
            ];
        }


        /**
         * @desc handle login request
         * @param Request $request
         * @return bool
         */
        public function solve($request){
            $this->loadData($request->getBody());

            if (!$this->validate()) return false;

            $user = User::findOne(['email' => $this->email]);

            if (!$user){
                $this->addError('email', 'User does not exist with this email address');
                return false;
            }

            if (!password_verify($this->password, $user->password)){
                $this->addError('password', 'Password is incorrect');
                return false;
            }

            return Application::$app->login($user);
        }
    }
?>