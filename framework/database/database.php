<?php

    namespace mvc\framework\database;

    class Database {
        public static function Connect() {
            require_once CONFIGS_PATH . 'dbconfig.php';
            try {
                return new \PDO('mysql:hostname=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
            } catch(\PDOException $e) {
                die('Connection error: ' . $e->getMessage());
            }
        }
    }