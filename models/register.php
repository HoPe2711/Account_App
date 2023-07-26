<?php
    class Register extends Authentication{
        public $first_name = '';
        public $last_name = '';
        public $email = '';
        public $password = '';
        public $confirm_password = '';

        /**
         * @desc define rules for register input
         * @return array
         */
        public function rules(){
            return [
                'first_name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 24]],
                'last_name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 24]],
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => User::class]],
                'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
                'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            ];
        }


        /**
         * @desc define labels for register input
         * @return array
         */
        public function labels(){
            return [
                'first_name' => 'First name',
                'last_name' => 'Last name',
                'email' => 'Email',
                'password' => 'Password',
                'confirm_password' => 'Confirm password',
            ];
        }


        /**
         * handle register and login when successful
         * @param $request
         * @return bool
         */
        public function solve($request){
            $this->loadData($request->getBody());
            $user = new User();
            $user->registerUser($this->first_name, $this->last_name, $this->email, $this->password);

            if (!$this->validate() || !$user->save()){
                return false;
            }

            $login = new Login();
            return $login->solve($request);
        }
    }
?>