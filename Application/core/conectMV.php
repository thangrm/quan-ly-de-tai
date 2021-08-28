<?php
class conectMV{
    // Role of request
    protected $role = -1;

    public $ROLE_GUEST = -1;
    public $ROLE_ADMIN = 1;
    public $ROLE_GIAOVIEN = 2;
    public $ROLE_SINHVIEN = 3;
    public $LIST_ALL_MEMBER = [1,2,3];
    public $LIST_ALL = [-1,1,2,3]; 

    function __construct(){
        $this->role = $this->getRoleUser();
    }

    /* Get the role of request */
    protected function getRoleUser() {
        if(isset($_SESSION['login']['role'])){
            return $_SESSION['login']['role'];
        }else{
            return $this->ROLE_GUEST;
        }
    }

    /* check the role of request */
    protected function checkAllowedRole($listRole = []){
        return in_array($this->role, $listRole);
    }

    /* method connect model*/
    protected function model($model)
    {
        require_once "./Application/models/".$model.".php";
        return new $model;
    }
    
    /* method connect view */
    protected function view($view, $data=[])
    {
        require_once "./Application/views/".$view.".php";
    }
}
?>