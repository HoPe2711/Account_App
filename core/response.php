<?php
    class Response{
        /**
         * @desc redirect
         * @param string $url
         */
        public function redirect($url){
            header('Location: '.$url);
        }
    }
?>