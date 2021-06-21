<?php

    class User{

        private $database;

        public function __construct(){
            $this->database = new Database;
        }

        public function insert($record){
            $values = [
                "name" => $record["name"],
                "email" => $record["email"],
            ];
            $this->database->insertRecord("users", $values);
        }


        public function getAll(){
            $this->database->prepareQuery("select * from users");
            return $this->database->getAllRecords();
        }

    }