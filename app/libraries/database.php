<?php

    class Database{

        private $host = DB_HOST;
        private $dbPort = DB_PORT;
        private $dbName = DB_NAME;
        private $user = DB_USER;
        private $password = DB_PASSWORD;

        private $pdo;
        private $stmt;
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


        public function prepareQuery($sql){
            var_dump($sql);

            $this->stmt = $this->pdo->prepare($sql);
        }


        public function insertRecord($tableName, $record){
            try{
                $columns = array_keys($record);
                $values = array_values($record);

                $query = $this->prepareQueryString($tableName, $columns, $values);

                $this->prepareQuery($query);
                $this->stmt->execute();
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }


        private function prepareQueryString($tableName, $columns, $values){
            $columns = $this->prepareInsertValues($columns, 0);
            $values = $this->prepareInsertValues($values, 1);

            $query = "INSERT INTO $tableName " . $columns . " values " .$values;
            return $query;
        }


        private function prepareInsertValues($items, $type){
            $resultString = "("; 

            foreach($items as $index => $item){
                if($type === 0){ // columns
                    $resultString .= $item;
                }else{           // $values
                    $resultString .= "'" . $item . "'";
                }

                if($index !== array_key_last($items)){
                    $resultString .= ", ";
                }
            }

            $resultString .= ")";
            return $resultString;
        }


        public function bindValues($param, $value, $type = null){
            if(is_null($type)){
                $type = $this->checkInputType($value);
            }

            $this->stmt->bindValue($param, $value, $type);
        }


        private function checkInputType($value){
            switch (true) {
                case is_int($value):
                    return PDO::PARAM_INT;
                case is_bool($value):
                    return PDO::PARAM_BOOL;
                case is_null($value):
                    return PDO::PARAM_NULL;
                default:
                    return PDO::PARAM_STR;
            }
        }


        public function executeQuery(){
            return $this->stmt->execute();
        }


        public function getAllRecords(){
            $this->executeQuery();
            return $this->stmt->fetchAll();
        }


        public function rowCount(){
            return $this->stmt->rowCount();
        }

    }