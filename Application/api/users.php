<?php
    class users extends API{
        function __construct(){
            parent::__construct();
        }

        function error(){
            echo $this->responseStatus(404); 
        }
        
        // Login
        function login(){
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
        function infor(){
            if($this->method == 'GET'){
                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);

                $id = null;
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }else if(isset($_SESSION['login']['id'])){
                    $id = $_SESSION['login']['id'];
                }

                if($checkRole && $id != null){
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

        function list(){
            if($this->method == 'GET'){
                $checkRole = $this->checkAllowedRole([$this->ROLE_ADMIN,
                                                        $this->ROLE_GIAOVIEN]);

                $name =  $this->getValueMethodGet('name', '');
                $roleUser =  $this->getValueMethodGet('role', $this->ROLE_SINHVIEN);
                $page = $this->getValueMethodGet('page', 1);
                $limit = $this->getValueMethodGet('limit', 25);

                // Validate input
                $validate = true;
                if($roleUser == 'sv'){
                    $roleUser = $this->ROLE_SINHVIEN;
                }else if($roleUser == 'gv'){
                    $roleUser = $this->ROLE_GIAOVIEN;
                }else if($roleUser == 'ad'){
                    $roleUser = $this->ROLE_ADMIN;
                }else{
                   $validate = false;
                }

                $regex = '/^[0-9]+$/';
                if(!preg_match($regex,$page) || (int)$page == 0){
                   $validate = false;
                }
                if(!preg_match($regex,$limit)){
                    $validate = false;
                 }
                
                if(!$validate){
                    echo $this->responseStatus(400); 
                    return;
                }

                // check role 
                if($checkRole){
                    $model = $this->model('userModel');
                    $listUsers = $model->getListUsers($name, $roleUser, $page, $limit);
                    echo $this->response($listUsers);
                }else{
                    echo $this->responseStatus(401); 
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }
    }
?>