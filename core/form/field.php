<?php
    class Field{
        const TYPE_TEXT = 'text';
        const TYPE_PASSWORD = 'password';
        public $model;
        public $attribute;
        public $type;
        public $label_option;
        public $placehoder;

        /**
         * @desc constructor
         * @param Authentication $model
         * @param string $attribute
         * @param string $label_option
         * @param string $placehoder
         */
        public function __construct($model, $attribute, $label_option, $placehoder){
            $this->type = self::TYPE_TEXT;
            $this->model = $model;
            $this->attribute = $attribute;
            $this->label_option = $label_option;
            $this->placehoder = $placehoder;
        }


        /**
         * @desc create field component
         * @return string html;
         */
        public function __toString(){
            return sprintf('
                <div class="row">
                    <div class="label">%s%s</div>
                    <div class="input">
                        <input type="%s" name="%s" value="%s" placeholder="%s">
                    </div>
                    <div class="invalid-feedback">
                        %s
                    </div>
                </div>
            ',
                $this->model->getLabel($this->attribute),
                $this->label_option,
                $this->type,
                $this->attribute,
                $this->model->{$this->attribute},
                $this->placehoder,
                $this->model->getFirstError($this->attribute)
            );
        }


        /**
         * @desc set type for field
         * @return Field
         */
        public function passwordField(){
            $this->type = self::TYPE_PASSWORD;
            return $this;
        }
    }
?>