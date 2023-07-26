<?php
    class Mysql{
        public $pdo;

        /**
         * @desc connect MySql
         * @param array $config
         */
        public function __construct($config){
            $dsn = $config['db']['dsn'] ?? '';
            $username = $config['db']['user'] ?? '';
            $password = $config['db']['password'] ?? '';
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }
?>