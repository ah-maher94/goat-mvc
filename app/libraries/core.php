<?php

    /**
     * APP Core Class
     * create url & load core controller
     * URL FORMAT - /controller/method/parameters
     */
    
    class Core{

        protected $currentControllerName = "Page";
        protected $currentMethod = "index";
        protected $parameters = [];

        public function __construct(){

            $urlComponetnsArray = $this->getURLComponents();
            $requiredControllerName = $urlComponetnsArray[0];
            $currentControllerPath = "../app/controllers/" . ucwords($requiredControllerName) . ".php";

            if(file_exists($currentControllerPath)){
                $this->currentControllerName = ucwords($requiredControllerName);
                unset($urlComponetnsArray[0]);
            }

            require_once $currentControllerPath;
            $this->currentControllerName = new $this->currentControllerName;

        }


        public function getURLComponents(){

            if(isset($_GET["url"])){
                $url = $_GET["url"];
                return $this->prepareURLComponents($url);
            }

        }


        public function prepareURLComponents($url){

            $url = rtrim($url, "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;

        }
        
    }