<?php 

// App core class
// creates url and loads core controller
// URL FORMAT - /controller/method/params


class Core{
    protected $currentPage = 'index';
    protected $params = [];

        public function __construct(){
            // print_r($this->getUrl());
            $url = $this->getUrl();

            //look in controllers for first value
            if(file_exists('ucodeTuts/'. ucwords($url[0]) . '.php')){
                
                //if exist as set controller
                 $this->currentPage = ucwords($url[0]);
                
                //unset 0 index
                unset($url[0]);                                                                                          
            }
                 //Require the controller
            require_once 'ucodeTuts/'. $this->currentPage . '.php';

            //Instantiate controller
            $this->currentPage = new $this->currentPage;
            
            //check for second path of url
            if(isset($url[1])){
                //check if method exist in controller
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];

                    //unset 1 index
                unset($url[1]);
                }
            }
            //Get parameters
            $this->params = $url ? array_values($url) : [];
           
            //call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            

        }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}