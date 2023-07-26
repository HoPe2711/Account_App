<?php
    abstract class Authentication{
        public const RULE_REQUIRED = 'required';
        public const RULE_EMAIL = 'email';
        public const RULE_MIN = 'min';
        public const RULE_MAX = 'max';
        public const RULE_MATCH = 'match';
        public const RULE_UNIQUE = 'unique';
        public array $errors = [];

        /**
         * @desc load data
         * @param array $data
         */
        public function loadData($data){
            foreach ($data as $key => $value){

                if (property_exists($this, $key)){
                    $this->{$key} = $value;
                }

            }
        }


        /**
         * @desc define rules for input
         */
        abstract public function rules();


        /**
         * @desc define labels for input
         */
        abstract function labels();


        /**
         * @desc get label of attribute
         * @param string $attribute
         * @return string label
         */
        public function getLabel($attribute){
            return $this->labels()[$attribute] ?? $attribute;
        }


        /**
         * @desc validate input data
         * @return bool
         */
        public function validate(){
            foreach ($this->rules() as $attribute => $rules){
                $value = $this->{$attribute};

                foreach ($rules as $rule){
                    $ruleName = $rule;

                    if (!is_string($rule)){
                        $ruleName = $rule[0];
                    }

                    if ($ruleName === self::RULE_REQUIRED && !$value){
                        $this->addErrorByRule($attribute, self::RULE_REQUIRED);
                    }

                    if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                        $this->addErrorByRule($attribute, self::RULE_EMAIL);
                    }

                    if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']){
                        $this->addErrorByRule($attribute, self::RULE_MIN, ['min' => $rule['min']]);
                    }

                    if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']){
                        $this->addErrorByRule($attribute, self::RULE_MAX, ['max' => $rule['max']]);
                    }

                    if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}){
                        $rule['match'] = $this->getLabel($rule['match']);
                        $this->addErrorByRule($attribute, self::RULE_MATCH, ['match' => $rule['match']]);
                    }

                    if ($ruleName === self::RULE_UNIQUE){
                        $className = $rule['class'];
                        $uniqueAttr = $rule['attribute'] ?? $attribute;
                        $tableName = $className::tableName();
                        $db = Application::$app->mysql;
                        $statement = $db->pdo->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                        $statement->bindValue(":$uniqueAttr", $value);
                        $statement->execute();
                        $record = $statement->fetchObject();

                        if ($record){
                            $this->addErrorByRule($attribute, self::RULE_UNIQUE);
                        }
                    }
                }
            }

            return empty($this->errors);
        }


        /**
         * @desc define error messages
         * @return array
         */
        public function errorMessages(){
            return [
                    self::RULE_REQUIRED => 'This field is required',
                    self::RULE_EMAIL => 'This field must be valid email address',
                    self::RULE_MIN => 'Min length of this field must be {min}',
                    self::RULE_MAX => 'Max length of this field must be {max}',
                    self::RULE_MATCH => 'This field must be the same as {match}',
                    self::RULE_UNIQUE => 'This {field} already exists',
            ];
        }


        /**
         * @desc create error by rule
         * @param string $attribute
         * @param string $rule
         * @param array $params
         */
        protected function addErrorByRule($attribute, $rule, $params = []){
            $params['field'] ??= $attribute;
            $errorMessage = $this->errorMessages()[$rule];

            foreach ($params as $key => $value){
                $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
            }

            $this->errors[$attribute][] = $errorMessage;
        }


        /**
         * @desc create error by undefined rule
         * @param string $attribute
         * @param string $message
         */
        public function addError($attribute, $message){
            $this->errors[$attribute][] = $message;
        }


        /**
         * @desc get first error of attribute
         * @param string $attribute
         * @return string|false
         */
        public function getFirstError($attribute){
            return $this->errors[$attribute][0] ?? false;
        }


        /**
         * @desc get first error of errors
         * @return string|false
         */
        public function checkErrors(){
            return reset($this->errors)[0] ?? false;
        }
    }
?>