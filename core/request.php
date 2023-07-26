<?php
    class Request{
        /**
         * @desc get path
         * @return string
         */
        public function getPath(){
            $path = $_SERVER['REQUEST_URI'] ?? '/';
            $position = strpos($path, "?");

            if ($position === false){
                return $path;
            }

            return substr($path, 0, $position);
        }


        /**
         * @desc get method
         * @return string
         */
        public function getMethod(){
            return strtolower($_SERVER['REQUEST_METHOD']);
        }


        /**
         * @desc check post method
         * @return bool
         */
        public function isPost(){
            return $this->getMethod() === 'post';
        }


        /**
         * @desc get data in request
         * @return array
         */
        public function getBody(){
            $data = [];

            if ($this->getMethod() === 'get'){
                foreach ($_GET as $key => $value){
                    $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }

            if ($this->getMethod() === 'post'){
                foreach ($_POST as $key => $value){
                    $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }

            return $data;
        }
    }
?>