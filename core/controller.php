<?php
    class Controller{
        /**
         * @desc render view
         * @param string $view
         * @param array $params
         * @return string html
         */
        public function render($view, $params = []){
            foreach ($params as $key => $value){
                $$key = $value;
            }

            ob_start();
            require_once Application::$ROOT_DIR."/views/$view.php";
            return ob_get_clean();
        }
    }
?>