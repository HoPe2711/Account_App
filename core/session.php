<?php
    class Session{
        /**
         * @desc constructor
         */
        public function __construct(){
            $timeout = 604800;
            ini_set( "session.gc_maxlifetime", $timeout );
            ini_set( "session.cookie_lifetime", $timeout );
            session_start();
        }


        /**
         * @desc create session data
         * @param string $key
         * @param string $value
         */
        public function set($key, $value){
            $_SESSION[$key] = $value;
        }


        /**
         * @desc get session data by key
         * @param $key
         * @return false|string
         */
        public function get($key){
            return $_SESSION[$key] ?? false;
        }


        /**
         * @desc remove session data
         * @param string $key
         */
        public function remove($key){
            unset($_SESSION[$key]);
        }
    }
?>