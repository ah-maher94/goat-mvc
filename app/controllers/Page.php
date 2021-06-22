<?php

    class Page extends Controller{

        public function __construct(){

        }

        public function index(){
            $this->loadview("hello");
        }

    }