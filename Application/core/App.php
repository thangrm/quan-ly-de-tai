<?php
    class App{
        protected $controller = "home";
        protected $action = "show";
        protected $params = [];

        function __construct(){
            $folderController = "./Application/controllers/";
            $arr = $this->urlProcess();

            //xu ly cotroller
            if(isset($arr[0])){
                if($arr[0] === "api"){
                    require_once "API.php";
                    array_shift($arr);
                    $folderController = "./Application/api/";
                    $this->controller = "notFound";
                    $this->action = "error";
                }

                if(file_exists($folderController.$arr[0].".php")){
                    $this->controller = array_shift($arr);
                }
            }

            require_once $folderController.$this->controller.".php";
            $this->controller = new $this->controller;

            //xu ly action
            if(isset($arr[0])){
                if(method_exists($this->controller,$arr[0])){
                    $this->action = array_shift($arr);
                }
            }
            
            //xu ly param
            $this->params = $arr?array_values($arr):[""];
            call_user_func_array([$this->controller,$this->action],$this->params);

        }
        
        function urlProcess(){
            if(isset($_GET["url"])){
                return explode("/",filter_var(trim($_GET["url"])));
            }
        }
    }
?>