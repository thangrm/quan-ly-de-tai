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
                if($checkRole){          
                    if(!isset($_GET['id'])){
                        echo $this->responseStatus(400);
                        return;
                    }

                    $id = $this->getValueMethodGet('id','');
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
                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                // check role 
                if($checkRole){
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
    
                    if(!$this->validatesAsInt($page)|| (int)$page == 0){
                       $validate = false;
                    }
                    if(!$this->validatesAsInt($limit)){
                        $validate = false;
                    }
                    
                    if(!$validate){
                        echo $this->responseStatus(400); 
                        return;
                    }    

                    // call model
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

        // add new a user
        function new(){
            if($this->method == 'POST'){
                $checkRole = $this->checkAllowedRole([$this->ROLE_ADMIN]);

                if($checkRole){
                    $roleUser = $this->getValueMethodPost('role',null);
                    $name = $this->getValueMethodPost('name',null);
                    $birthday = $this->getValueMethodPost('birthday',null);
                    $email = $this->getValueMethodPost('email',null);
                    $phone = $this->getValueMethodPost('phone',null);
                    $address = $this->getValueMethodPost('address',null);
                    $majors = $this->getValueMethodPost('majors',null);
                    $kh = $this->getValueMethodPost('kh',null);
                    $ns = $this->getValueMethodPost('ns',null);

                    // Validate input
                    $validate = true;
                    if($roleUser == 'sv'){
                        $roleUser = $this->ROLE_SINHVIEN;
                    }else if($roleUser == 'gv'){
                        $roleUser = $this->ROLE_GIAOVIEN;
                    }else{
                        $validate = false;
                    }
                    
                    $tempDate = explode('-', $birthday);
                    if(count($tempDate) != 3){
                        $validate = false;
                    }else{
                        if(is_numeric($tempDate[0]) && is_numeric($tempDate[1]) && is_numeric($tempDate[2])){
                            $validate = checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
                        }else{
                            $validate = false;
                        }
                    }
 
                    if(!$validate){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // call model
                    $model = $this->model('userModel');
                    $rs = $model->add($roleUser, $name, $birthday, $email, $phone, $address, $majors, $kh, $ns);
                    if($rs['register'])
                        echo $this->response($rs);
                    else
                        echo $this->responseStatus($rs['code']);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // update user
        function update($id){
            if($this->method == 'POST'){
                if($id == null){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                if($checkRole){
                    if($this->role != $this->ROLE_ADMIN){
                        if($id != $_SESSION['login']['id']){
                            echo $this->responseStatus(401);
                            return;
                        }
                    }

                    $pass = $this->getValueMethodPost('pass',null);
                    $name = $this->getValueMethodPost('name',null);
                    $birthday = $this->getValueMethodPost('birthday',null);
                    $avatar = null;
                    $email = $this->getValueMethodPost('email',null);
                    $phone = $this->getValueMethodPost('phone',null);
                    $address = $this->getValueMethodPost('address',null);
                    $majors = $this->getValueMethodPost('majors',null);
                    $kh = $this->getValueMethodPost('kh',null);
                    $ns = $this->getValueMethodPost('ns',null);

                    // Validate input
                    $validate = true;
            
                    if($birthday != null){
                        $tempDate = explode('-', $birthday);
                        if(count($tempDate) != 3){
                            $validate = false;
                        }else{
                            if(is_numeric($tempDate[0]) && is_numeric($tempDate[1]) && is_numeric($tempDate[2])){
                                $validate = checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
                            }else{
                                $validate = false;
                            }
                        }
                    }
                    if($pass != null){
                        $pass = password_hash($pass, PASSWORD_DEFAULT);
                    }
                        
                    if(!$validate){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    if(isset($_FILES['avatar'])){
                        if($_FILES['avatar']['error'] > 0){
                            echo $this->responseStatus(400); 
                            return;
                        }else{
                            $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                            $nameFile = $id.'.'.$ext;
                            if(move_uploaded_file($_FILES['avatar']['tmp_name'], getRealPathStorage('avatar/'.$nameFile))){
                                $avatar = $nameFile;
                            }
                            
                        }
                    }
                    
                    // call model
                    $model = $this->model('userModel');
                    $rs = $model->update($id, $pass, $name, $birthday, $avatar, $email, $phone, $address, $majors, $kh, $ns);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // remove user
        function remove($id){
            if($this->method == 'DELETE'){
                if($id == null){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_ADMIN]);
                if($checkRole){
                    // call model
                    $model = $this->model('userModel');
                    $rs = $model->remove($id);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }
    }
?>