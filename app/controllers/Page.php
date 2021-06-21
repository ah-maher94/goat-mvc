<?php

    class Page extends Controller{

        public function __construct(){

            $this->userModel = $this->loadModel("user");
            $record = ["name" => "AhmedFinal", "email" => "ahmed@gmail.com"];
            $this->userModel->insert($record);
        
        }

        public function index(){
            
            $data = $this->userModel->getAll();
            $this->loadview("hello", $data);
        
        }

    }