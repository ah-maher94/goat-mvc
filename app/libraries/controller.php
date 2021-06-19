<?php

    /**
     * load models and views 
     */

    class Controller{

        public function loadModel($model){

            $modelPath = "../app/models/" . ucfirst($model) . ".php";
            if(file_exists($modelPath)){
                require_once $modelPath;
                return new $model;
            }else{
                die("Required file doesn't exist");
            }

        }


        public function loadView($view, $data = []){

            $viewPath = "../app/views/" . $view . ".php";
            if(file_exists($viewPath)){
                require_once $viewPath;
            }else{
                die("Required page doesn't exist");
            }

        }

    }