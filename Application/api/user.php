<?php
    class user extends API{
        function __construct(){
            parent::__construct();
        }

        function error(){
            echo $this->responseStatus(404); 
        }
        
        function login(){
            $res = array();
            if($this->method == 'POST'){
                if(!empty($_POST["username"] && $_POST["password"]))
                {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $model = $this->model("loginModel");
                    $user = $model->check_login(['username'=>$username,
                                                 'password'=>$password]);
                    if(!empty($user))
                    {
                        $_SESSION['login'] = $user;
                        $res = ['login' => true,
                                'infor' => $user];
                    }else{
                        $res = ['login' => false,
                                'infor' => null];
                    }
                    echo $this->response($res);                            
                }            
            }else{
                echo $this->responseStatus(405); 
            }
   
        }
    }
?>