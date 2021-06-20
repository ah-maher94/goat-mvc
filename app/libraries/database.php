<?php

    class Database{

        private $host = DB_HOST;
        private $dbPort = DB_PORT;
        private $dbName = DB_NAME;
        private $user = DB_USER;
        private $password = DB_PASSWORD;

        private $pdo;
        private $error;

        public function __construct(){

            $dsn = "mysql:host=" . $this->host . ";port=" . $this->dbPort . ";dbname=" . $this->dbName;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try{
                $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }

        }



    }