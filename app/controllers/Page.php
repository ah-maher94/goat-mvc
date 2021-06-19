<?php

    class Page extends Controller{

        public function __construct(){

            echo "Page Controller";
        
        }

        public function index(){
            $this->loadview("hello");
        }

    }