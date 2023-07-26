<?php
    abstract class PersistenceAPI{
        /**
         * @desc define table of class in database
         */
        abstract public static function tableName();


        /**
         * @desc define attributes for insert data
         */
        abstract public function attributes();


        /**
         * @desc define primary key of table of class
         */
        abstract static public function primaryKey();


        /**
         * @desc insert data into table in database
         * @return bool
         */
        public function save(){
            $table_name = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":$attr", $attributes);
            $statement = self::prepare("INSERT INTO $table_name (" . implode(",", $attributes) . ") VALUES (" . implode(",", $params) . ")");

            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            return $statement->execute();
        }


        /**
         * @desc set query
         * @param string $sql
         * @return false|PDOStatement
         */
        public static function prepare($sql){
            return Application::$app->mysql->pdo->prepare($sql);
        }


        /**
         * @desc find data by attributes
         * @param array $where
         * @return false|object
         */
        public static function findOne($where){
            $tableName = static::tableName();
            $attributes = array_keys($where);
            $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }

            $statement->execute();
            return $statement->fetchObject(static::class);
        }


        /**
         * update data by attributes
         * @param array $attributes
         * @param string $user_id
         * @return bool
         */
        public static function updateOne($attributes, $user_id){
            $tableName = static::tableName();
            $query = "";

            foreach ($attributes as $key=>$value){
                $query = $query. $key . "='" . $value . "', ";
            }

            $query = substr($query,0, -2);
            $statement = self::prepare("update $tableName set " . $query . "  where id = $user_id");
            return $statement->execute();
        }
    }
?>