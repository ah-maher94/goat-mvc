<?php

    /**
     * create url & load core controller
     * URL FORMAT - /controller/method/parameters
     */
    
    class Core{

        protected $currentController = "Page";
        protected $currentMethod = "index";
        protected $parameters = [];

        public function __construct(){

            $urlComponetnsArray = $this->getURLComponents();
            $requiredController = ucwords($urlComponetnsArray[0]) ?: $this->currentController;
            $currentControllerPath = "../app/controllers/" . $requiredController . ".php";

            if(file_exists($currentControllerPath)){
                $this->currentController = $requiredController;
                unset($urlComponetnsArray[0]);
            }

            $this->loadRequiredController($currentControllerPath);

            if(isset($urlComponetnsArray[1])){
                $requiredMethodName = $urlComponetnsArray[1];

                if(method_exists($this->currentController, $requiredMethodName)){
                    $this->currentMethod = $requiredMethodName;
                }

                unset($urlComponetnsArray[1]);
            }
  
            $this->parameters = $urlComponetnsArray ? array_values($urlComponetnsArray) : [];
            
            call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);

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


        public function loadRequiredController($currentControllerPath){

            require_once $currentControllerPath;
            $this->currentController = new $this->currentController;

        }
        
    }