<?php
    class users extends API{
        function __construct(){
            parent::__construct();
        }

        function error(){
            echo $this->responseStatus(404); 
        }
        
        // Login
        function login($param){
            $res = array();
            if($this->method == 'POST'){
                if(!empty($_POST['username'] && $_POST['password']))
                {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $model = $this->model('loginModel');
                    $user = $model->checkLogin($username,$password);
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
                }else{
                    echo $this->responseStatus(400); 
                }          
            }else{
                echo $this->responseStatus(405); 
            }
        }

        // Logout
        function logout(){
            if($this->method == 'GET'){
                unset($_SESSION['login']);
                echo $this->responseStatus(200,'logged out');
            }else{
                echo $this->responseStatus(405); 
            }
        }

        // Get infor user
        function infor($param){
            if($this->method == 'GET'){
                $checkRole = true;
                $id = $_SESSION['login']['id'];
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                  
                if($this->role == $this->SINHVIEN_ROLE){
                    if($id != $_SESSION['login']['id'])
                        $checkRole = false;
                }else if($this->role == null){
                    $checkRole = false; 
                }

                if($checkRole){
                    $model = $this->model('userModel');
                    $user = $model->getUserByID($id);
                    echo $this->response($user);
                }else{
                    echo $this->responseStatus(401); 
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }
    }
?>