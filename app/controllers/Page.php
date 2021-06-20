<?php

    class Page extends Controller{

        public function __construct(){

            $this->userModel = $this->loadModel("user");
        
        }

        public function index(){

            $this->loadview("hello", ["title"=>"GOAT"]);
        
        }

    }