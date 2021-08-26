<?php
    class assignment extends API{
        function __construct(){
            parent::__construct();
        }

        function error(){
            echo $this->responseStatus(404); 
        }

        // Get infor assignment
        function infor($id){
            if($this->method == 'GET'){
                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
                if($checkRole){          
                    if($id == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // Validate input
                    $validate = true;
                    if(!$this->validatesAsInt($id)){
                        $validate = false;
                    }
                    
                    if(!$validate){
                        echo $this->responseStatus(400); 
                        return;
                    }    

                    $sv_id = null;
                    if($this->role == $this->ROLE_SINHVIEN){
                        $sv_id =  $_SESSION['login']['id'];
                    }
                    
                    $model = $this->model('assignmentModel');
                    $assignment = $model->getAssignmentByID($id,$sv_id);
                    echo $this->response($assignment);
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
                    $gid =  $this->getValueMethodGet('gid', null);
                    $page = $this->getValueMethodGet('page', 1);
                    $limit = $this->getValueMethodGet('limit', 25);
    
                    // Validate input
                    $validate = true;
                    if(!$this->validatesAsInt($gid)){
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
                    $model = $this->model('assignmentModel');
                    $listAssignment = $model->getAssignmentByGroup($gid, $page, $limit);
                    if($listAssignment == 400){
                        echo $this->responseStatus(400); 
                    }else{
                        echo $this->response($listAssignment);
                    }
                        
                }else{
                    echo $this->responseStatus(401); 
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // add new a assignment
        function new(){
            if($this->method == 'POST'){
                $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);

                if($checkRole){
                    $gid = $this->getValueMethodPost('gid',null);
                    $title = $this->getValueMethodPost('title',null);
                    $content = $this->getValueMethodPost('content',null);
                    $hannop = $this->getValueMethodPost('deadline', null);
                    
                    // validate input
                    $validate = true;
                    if($gid == null || $title == null){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    $tempDate = explode('-', $hannop);
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
                    $model = $this->model('assignmentModel');
                    $rs = $model->add($gid, $title, $content, $hannop);
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

         // update assignment
        function update($id){
            if($this->method == 'POST'){
                if($id == null){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);
                if($checkRole){
                    $title = $this->getValueMethodPost('title',null);
                    $content = $this->getValueMethodPost('content',null);
                    $hannop = $this->getValueMethodPost('deadline', null);

                    // Validate input
                    $validate = true;
                    if(!$this->validatesAsInt($id)){
                        $validate = false;
                    }

                    $tempDate = explode('-', $hannop);
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

                    $model = $this->model('assignmentModel');
                    $assignment = $model->getAssignmentByID($id);

                    if($assignment == null){
                        $rs = ['update'=>false,
                               'message' => 'Mã bài tập không tồn tại',
                               'cod' => 200];
                        echo $this->response($rs);
                        return;
                    }
                    // compare data change
                    if($title == null){
                        $title = $assignment['title'];
                    }
            
                    if($content == null){
                        $content = $assignment['content'];
                    }
            
                    if($hannop == null){
                        $hannop = $assignment['deadline'];
                    }

                    // call model
                    $rs = $model->update($id, $title, $content, $hannop);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        // remove assignment
        function remove($id){
            if($this->method == 'DELETE'){
                if($id == null){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);
                if($checkRole){
                    
                    $model = $this->model('assignmentModel');
                    $assignment = $model->getAssignmentByID($id);
                    
                    // validate input
                    if($assignment == null){
                        $rs = ['delete'=>false,
                               'message' => 'Mã bài tập không tồn tại',
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

        // submit assignment for student
        function submit($id){
            if($this->method == 'POST'){
                if($id == null || !$this->validatesAsInt($id)){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_SINHVIEN]);
                if($checkRole){
                    $model = $this->model('assignmentModel');
                    $assignment = $model->getAssignmentByDetailID($id);
                    
                    // validate input
                    if($assignment == null){
                        $rs = ['update'=>false,
                               'message' => 'Mã chi tiết bài tập không tồn tại',
                               'cod' => 200];
                        echo $this->response($rs);
                        return;
                    }

                    $file = null;
                    if(isset($_FILES['fileSubmit'])){
                        if($_FILES['fileSubmit']['error'] > 0){
                            echo $this->responseStatus(400); 
                            return;
                        }else{
                            // file save path
                            // group/{mã nhóm}/{mã bài tập}/{mã chi tiết bài tập}/{tên file}
                            $gid = $assignment['gid'];
                            $assign_id = $assignment['id'];
                            $nameFile = $_FILES['fileSubmit']['name'];
                            $folderSave = 'group/'.$gid.'/'.$assign_id.'/'.$id;
                         
                            // check folder isset
                            if(!is_dir(getRealPathStorage($folderSave))){
                                mkdir(getRealPathStorage($folderSave), 0755, true);
                            }

                            $pathSave = $folderSave.'/'.$nameFile;
                            if(move_uploaded_file($_FILES['fileSubmit']['tmp_name'], getRealPathStorage($pathSave))){
                                $file = $nameFile;
                            }else{
                                echo $this->responseStatus(500); 
                                return;
                            }
                        }
                    }
                    // call model
                    $rs = $model->submit($id, $file);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        function assess($id){
            if($this->method == 'POST'){
                if($id == null || !$this->validatesAsInt($id)){
                    echo $this->responseStatus(400); 
                    return;
                }

                $checkRole = $this->checkAllowedRole([$this->ROLE_GIAOVIEN]);
                if($checkRole){
                    $score = $this->getValueMethodPost('score',null);
                    $model = $this->model('assignmentModel');
                    $assignment = $model->getAssignmentByDetailID($id);

                    // validate input
                    if($assignment == null){
                        $rs = ['update'=>false,
                               'message' => 'Mã chi tiết bài tập không tồn tại',
                               'cod' => 200];
                        echo $this->response($rs);
                        return;
                    }
                    if(!$this->validatesAsInt($score)){
                        echo $this->responseStatus(400); 
                        return;
                    }

                    // call model
                    $rs = $model->assess($id, $score);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(401);
                }

            }else{
                echo $this->responseStatus(405); 
            }
        }

        function opinion($id){
            if($id == null || !$this->validatesAsInt($id)){
                echo $this->responseStatus(400);
                return;
            }
            $checkRole = $this->checkAllowedRole($this->LIST_ALL_MEMBER);
            if($checkRole){
                if($this->method == 'GET'){
                    // call model
                    $model = $this->model('assignmentModel');
                    $rs = $model->getOpinion($id);
                    echo $this->response($rs);
                    
                }else if($this->method == 'POST'){

                    $uid = $_SESSION['login']['id'];
                    $content = $this->getValueMethodPost('content',null);
                    $model = $this->model('assignmentModel');
                    $assignment = $model->getAssignmentByDetailID($id);

                    // validate input
                    if($assignment == null){
                        $rs = ['update'=>false,
                            'message' => 'Mã chi tiết bài tập không tồn tại',
                            'cod' => 200];
                        echo $this->response($rs);
                        return;
                    }

                    // call model
                    $rs = $model->addOpinion($id, $uid, $content);
                    echo $this->response($rs);
                }else{
                    echo $this->responseStatus(405); 
                }
            }else{
                echo $this->responseStatus(401);
            }
        }
    }
?>