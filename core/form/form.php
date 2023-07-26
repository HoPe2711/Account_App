<?php
    class Form{
        /**
         * create form component
         * @param string $id
         * @param string $action
         * @param string $method
         * @param $options
         * @return Form
         */
        public static function begin($id, $action, $method){
            echo sprintf('<form id= "%s" action="%s" method="%s">', $id, $action, $method);
            return new Form();
        }

        /**
         * @desc create end form tag
         */
        public static function end(){
            echo '</form>';
        }


        /**
         * @desc create field in form
         * @param Authentication $model
         * @param string $attribute
         * @param string $label_option
         * @param string $placeholder
         * @return Field
         */
        public function field($model, $attribute, $label_option, $placeholder){
            return new Field($model, $attribute, $label_option, $placeholder);
        }
    }
?>