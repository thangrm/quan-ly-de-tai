<?php
    class group extends API{
        function __construct(){
            parent::__construct();
        }

        function error(){
            echo $this->responseStatus(404); 
        }

        // Get infor group
        function infor($id){
            if($this->method == 'GET'){
                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                if($checkRole){          
                    if($id == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    $model = $this->model('groupModel');
                    $group = $model->getGroupByID($id);
                    echo $this->response($group);
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
                    $uid =  $this->getValueMethodGet('uid', null);
                    $page = $this->getValueMethodGet('page', 1);
                    $limit = $this->getValueMethodGet('limit', 25);
    
                    // Validate input
                    $validate = true;
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
                    $model = $this->model('groupModel');
                    $listGroup = $model->getGroupByUser($uid, $page, $limit);
                    if($listGroup == 400){
                        echo $this->responseStatus(400); 
                    }else{
                        echo $this->response($listGroup);
                    }
                        
                }else{
                    echo $this->responseStatus(401); 
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // add new group
        function new(){
            if($this->method == 'POST'){
                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);

                if($checkRole){
                    $uid = null;
                    if(isset($_SESSION['login']['id'])){
                        $uid = $_SESSION['login']['id'];
                    }
                    $name = $this->getValueMethodPost('name',null);
                    
                    // validate input
                    if($name == null || $uid == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // call model
                    $model = $this->model('groupModel');
                    $rs = $model->add($uid, $name);
                    if($rs)
                        echo $this->response(['success'=> true,
                                              'cod' => 200]);
                    else
                        echo $this->responseStatus(400);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

         // update group
        function update($g_id){
            if($this->method == 'POST'){
                if($g_id == null){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);
                if($checkRole){
                    $uid = null;
                    if(isset($_SESSION['login']['id'])){
                        $uid = $_SESSION['login']['id'];
                    }
                    $name = $this->getValueMethodPost('name',null);

                    // validate input
                    if($name == null || $g_id == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // call model
                    $model = $this->model('groupModel');
                    $group = $model->getGroupByID($g_id);
                    if($group == null){
                        $rs = ['update'=>false,
                               'message' => 'Mã nhóm không tồn tại',
                               'cod' => 400];
                        echo $this->response($rs,400);
                        return;
                    }else if($group['gv_id'] != $uid){
                        echo $this->responseStatus(401);
                        return;
                    }

                    $rs = $model->update($g_id, $name);
                    if($rs['update']){
                        echo $this->response($rs);
                    }else{
                        echo $this->response($rs,$rs['cod']);
                    }
    
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // remove user
        function remove($g_id){
            if($this->method == 'DELETE'){
                if($g_id == null){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);
                if($checkRole){
                    $uid = null;
                    if(isset($_SESSION['login']['id'])){
                        $uid = $_SESSION['login']['id'];
                    }

                    //call model
                    $model = $this->model('groupModel');
                    $group = $model->getGroupByID($g_id);
                    if($group == null){
                        $rs = ['delete'=>false,
                               'message' => 'Mã nhóm không tồn tại',
                               'cod' => 400];
                        echo $this->response($rs,400);
                        return;
                    }else if($group['gv_id'] != $uid){
                        echo $this->responseStatus(401);
                        return;
                    }

                    $rs = $model->remove($g_id);
                    if($rs['delete']){
                        echo $this->response($rs);
                    }else{
                        echo $this->response($rs,$rs['cod']);
                    }
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        /*Member*/
        function member($g_id){
            // validate input
            if($g_id == null){
                echo $this->responseStatus(400); 
                return;
            }

            $uid = null;
            if(isset($_SESSION['login']['id'])){
                $uid = $_SESSION['login']['id'];
            }

            $model = $this->model('groupModel');
            $group = $model->getGroupByID($g_id);
            if($group == null){
                echo $this->responseStatus(400,'Mã nhóm không tồn tại');
                return;
            }else if($group['gv_id'] != $uid){
                echo $this->responseStatus(401);
                return;
            }

            $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);
            if($checkRole){
                /*          */
                /*get member*/
                /*          */
                if($this->method == 'GET'){
                    // call model
                    $group = $model->getGroupByID($g_id);
                    if($group == null){
                        echo $this->responseStatus(400,'Mã nhóm không tồn tại');
                        return;
                    }else if($group['gv_id'] != $uid){
                        echo $this->responseStatus(401);
                        return;
                    }

                    $rs = $model->getMember($g_id);
                    echo $this->response($rs);
    
                /*          */
                /*add member*/
                /*          */
                }else if($this->method == 'POST'){
                    $sv_id = $this->getValueMethodPost('sv_id',null);
                    if($sv_id == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // call model
                    $group = $model->getGroupByID($g_id);
                    if($group == null){
                        echo $this->responseStatus(400,'Mã nhóm không tồn tại');
                        return;
                    }else if($group['gv_id'] != $uid){
                        echo $this->responseStatus(401);
                        return;
                    }

                    $rs = $model->addMember($g_id, $sv_id);
                    if($rs)
                        echo $this->response(['success'=> true,
                                                'cod' => 200]);
                    else
                        echo $this->responseStatus(400);
                        
                /*             */
                /*remove member*/
                /*             */
                }else if($this->method == 'DELETE'){
                    // validate input
                    $sv_id = $this->getValueMethodGet('sv_id',null);
                    if($sv_id == null){
                        echo $this->responseStatus(400); 
                        return;
                    }
                    
                    // call model
                    $rs = $model->removeMember($g_id, $sv_id);
                    if($rs)
                        echo $this->response(['success'=> true,
                                                'cod' => 200]);
                    else
                        echo $this->responseStatus(400);
                }
                else{
                    echo $this->responseStatus(405); 
                }
            }else{
              echo $this->responseStatus(401);
            }
        }

    }
?>