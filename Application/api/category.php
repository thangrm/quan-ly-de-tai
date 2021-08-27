<?php
    class category extends API{
        function __construct(){
            parent::__construct();
        }

        function error(){
            echo $this->responseStatus(404); 
        }
        
        //get infor category
        function list(){
            if($this->method == 'GET'){
                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                // check role 
                if($checkRole){
                    // call model
                    $model = $this->model('categoryModel');
                    $listCategory = $model->getListCategory();
                    if($listCategory == 400){
                        echo $this->responseStatus(400); 
                    }else{
                        echo $this->response($listCategory);
                    }
                        
                }else{
                    echo $this->responseStatus(401); 
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // add new a category
        function new(){
            if($this->method == 'POST'){
                $checkRole = $this->checkAllowedRole([$this->ROLE_ADMIN]);

                if($checkRole){
                    $name = $this->getValueMethodPost('name',null);
                    // validate input
                    if($name == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // call model
                    $model = $this->model('categoryModel');
                    $rs = $model->add($name);
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

         // update category
        function update($cat_id){
            if($this->method == 'POST'){
                if($cat_id == null || !$this->validatesAsInt($cat_id)){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_ADMIN]);
                if($checkRole){
                    $name = $this->getValueMethodPost('name',null);
                    // validate input
                    if($name == null){
                        echo $this->responseStatus(400); 
                        return;
                    }
        
                    // call model
                    $model = $this->model('categoryModel');
                    $rs = $model->update($cat_id, $name);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // remove category
        function remove($cat_id){
            if($this->method == 'DELETE'){
                if($cat_id == null || !$this->validatesAsInt($cat_id)){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_ADMIN]);
                if($checkRole){
                    // call model
                    $model = $this->model('categoryModel');
                    $rs = $model->remove($cat_id);
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