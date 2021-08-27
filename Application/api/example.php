<?php
    class example extends API{
        function __construct(){
            parent::__construct();
        }

        function error(){
            echo $this->responseStatus(404); 
        }

        // Get infor example
        function infor($id){
            if($this->method == 'GET'){
                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                if($checkRole){          
                    if($id == null || !$this->validatesAsInt($id)){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    $model = $this->model('exampleModel');
                    $example = $model->getExampleByID($id);
                    echo $this->response($example);
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
                    $model = $this->model('exampleModel');
                    $listExample = $model->getListExample($uid, $title, $page, $limit);
                    if($listExample == 400){
                        echo $this->responseStatus(400); 
                    }else{
                        echo $this->response($listExample);
                    }
                        
                }else{
                    echo $this->responseStatus(401); 
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // add new a example
        function new(){
            if($this->method == 'POST'){
                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);

                if($checkRole){
                    $gv_id = $_SESSION['login']['id'];
                    $cat_id = $this->getValueMethodPost('cat_id',null);
                    $title = $this->getValueMethodPost('title',null);
                    $des = $this->getValueMethodPost('des',null);
                    
                    // validate input
                    if($cat_id == null || $gv_id == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // call model
                    $model = $this->model('exampleModel');
                    $rs = $model->add($cat_id, $gv_id, $title, $des);
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

         // update example
        function update($id){
            if($this->method == 'POST'){
                if($id == null || !$this->validatesAsInt($id)){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);
                if($checkRole){
                    $cat_id = $this->getValueMethodPost('cat_id',null);
                    $title = $this->getValueMethodPost('title',null);
                    $des = $this->getValueMethodPost('des',null);

                    // Validate input
                    $model = $this->model('exampleModel');
                    $example = $model->getExampleByID($id);
                    if($example == null){
                        $rs = ['update'=>false,
                               'message' => 'Mã đề tài mẫu không tồn tại',
                               'cod' => 200];
                        echo $this->response($rs);
                        return;
                    }

                    // compare data change
                    if($cat_id == null){
                        $cat_id = $example['cat']['cat_id'];
                    }
            
                    if($title == null){
                        $title = $example['title'];
                    }
            
                    if($des == null){
                        $des = $example['des'];
                    }

                    // call model
                    $rs = $model->update($id, $cat_id, $title, $des);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // remove example
        function remove($id){
            if($this->method == 'DELETE'){
                if($id == null || !$this->validatesAsInt($id)){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);
                if($checkRole){
                    $model = $this->model('exampleModel');
                    $example = $model->getExampleByID($id);
                    if($example == null){
                        $rs = ['delete'=>false,
                               'message' => 'Mã đề tài không tồn tại',
                               'cod' => 200];
                        echo $this->response($rs);
                        return;
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