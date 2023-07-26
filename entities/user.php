<?php
    class User extends PersistenceAPI{
        public $first_name = '';
        public $last_name = '';
        public $email = '';
        public $password = '';
        public $username;
        public $job_title;
        public $profile_image;
        public $birthday;
        public $phone;
        public $address;

        /**
         * @desc setter for register user
         * @param string $first_name
         * @param string $last_name
         * @param string $email
         * @param string $password
         */
        public function registerUser($first_name, $last_name, $email, $password){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->password = $password;
        }


        /**
         * @desc define table of class in database
         * @return string
         */
        public static function tableName(){
            return 'Users';
        }


        /**
         * @desc define primary key of table of class
         * @return string
         */
        public static function primaryKey(){
            return 'id';
        }


        /**
         * @desc save user in database
         * @return bool
         */
        public function save(){
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            return parent::save();
        }


        /**
         * @desc define attributes for insert data
         * @return array
         */
        public function attributes(){
            return ['first_name', 'last_name', 'email', 'password'];
        }
    }
?>