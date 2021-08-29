<?php
    class thesis extends API{
        function __construct(){
            parent::__construct();
        }

        function error(){
            echo $this->responseStatus(404); 
        }

        // Get infor thesis
        function infor($id){
            if($this->method == 'GET'){
                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                if($checkRole){          
                    if($id == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    $model = $this->model('thesisModel');
                    $thesis = $model->getThesisByID($id);
                    echo $this->response($thesis);
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
                    $cat_id =  $this->getValueMethodGet('cat_id', -1);
                    $title =  $this->getValueMethodGet('title', '');
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
                    $model = $this->model('thesisModel');
                    $listThesis = $model->getThesisByUser($uid, $cat_id, $title, $page, $limit);
                    if($listThesis == 400){
                        echo $this->responseStatus(400); 
                    }else{
                        echo $this->response($listThesis);
                    }
                        
                }else{
                    echo $this->responseStatus(401); 
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // add new a thesis
        function new(){
            if($this->method == 'POST'){
                $checkRole = $this->checkAllowedRole([$this->ROLE_SINHVIEN]);

                if($checkRole){
                    $cat_id = $this->getValueMethodPost('cat_id',null);
                    $sv_id = $this->getValueMethodPost('sv_id',null);
                    $gv_id = $this->getValueMethodPost('gv_id',null);
                    $title = $this->getValueMethodPost('title',null);
                    $des = $this->getValueMethodPost('des',null);
                    
                    // validate input
                    if($cat_id == null || $sv_id == null || $gv_id == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // call model
                    $model = $this->model('thesisModel');
                    $rs = $model->add($cat_id, $sv_id, $gv_id, $title, $des);
                    if($rs)
                        echo $this->response(['success'=> true,
                                              'cod' => 200]);
                    else
                    echo $this->response(['success'=> false,
                                          'cod' => 200]);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

         // update thesis
        function update($id){
            if($this->method == 'POST'){
                if($id == null){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                if($checkRole){
                    $cat_id = $this->getValueMethodPost('cat_id',null);
                    $gv_id = $this->getValueMethodPost('gv_id',null);
                    $title = $this->getValueMethodPost('title',null);
                    $des = $this->getValueMethodPost('des',null);
                    $approve = $this->getValueMethodPost('approve',null);
                    $complete = $this->getValueMethodPost('complete',null);

                    if($this->role == $this->ROLE_SINHVIEN){
                        if($approve != null || $complete != null){
                            echo $this->responseStatus(401);
                            return;
                        }
                    }

                    $model = $this->model('thesisModel');
                    $thesis = $model->getThesisByID($id);
                    if($thesis == null){
                        $rs = ['update'=>false,
                               'message' => 'Mã đề tài không tồn tại',
                               'cod' => 200];
                        echo $this->response($rs);
                        return;
                    }

                    if($this->role != $this->ROLE_ADMIN){
                        $uid = $_SESSION['login']['id'];
                        if($uid != $thesis['sv']['sv_id'] && $uid != $thesis['gv']['gv_id']){
                            echo $this->responseStatus(401);
                            return;
                        }
                    }

                    // Validate input
                    $validate = true;
                    if($complete != null){
                        if(!$this->validatesAsInt($complete)){
                            $validate = false;
                        }else{
                            $tmp = (int)$complete;
                            if($tmp < 0 || $tmp > 1){
                                $validate = false;
                            }
                        }
                    }
                    
                    if($approve != null){
                        if(!$this->validatesAsInt($approve)){
                            $validate = false;
                        }else{
                            $tmp = (int)$approve;
                            if($tmp < 0 || $tmp > 1){
                                $validate = false;
                            }
                        }
                    }
                    
                    if(!$validate){
                        echo $this->responseStatus(400); 
                        return;
                    }    
                    
                    // compare data change
                    if($cat_id == null){
                        $cat_id = $thesis['cat']['cat_id'];
                    }

                    if($gv_id == null){
                        $gv_id = $thesis['gv']['gv_id'];
                    }
            
                    if($title == null){
                        $title = $thesis['title'];
                    }
            
                    if($des == null){
                        $des = $thesis['des'];
                    }
            
                    if($approve == null){
                        $approve = $thesis['approve'];
                    }
            
                    if($complete == null){
                        $complete = $thesis['complete'];
                    }

                    // call model
                    $rs = $model->update($id, $cat_id, $gv_id, $title, $des, $approve, $complete);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // remove thesis
        function remove($id){
            if($this->method == 'DELETE'){
                if($id == null){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                if($checkRole){
                    $model = $this->model('thesisModel');
                    $thesis = $model->getThesisByID($id);
                    if($thesis == null){
                        $rs = ['delete'=>false,
                               'message' => 'Mã đề tài không tồn tại',
                               'cod' => 200];
                        echo $this->response($rs);
                        return;
                    }

                    if($this->role != $this->ROLE_ADMIN){
                        $uid = $_SESSION['login']['id'];
                        if($uid != $thesis['sv']['sv_id'] && $uid != $thesis['gv']['gv_id']){
                            echo $this->responseStatus(401);
                            return;
                        }
                    }
                    // call model
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