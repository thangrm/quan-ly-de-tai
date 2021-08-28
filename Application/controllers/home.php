<?php
    class home extends conectMV{
        function __construct(){
            parent::__construct();
        }

        function show(){
            //model
            echo $this->role;
            //view
            if($this->role == $this->ROLE_SINHVIEN){
                $vi = $this->view("layout-sv", ["page"=>"home"]);

            }else if($this->role == $this->ROLE_GIAOVIEN){
                $vi = $this->view("layout-gv", ["page"=>"home"]);

            }else if($this->role == $this->ROLE_ADMIN){
                $vi = $this->view("layout-admin", ["page"=>"home"]);

            }else{
                header('Location: '.getUrl('login'));
            }
            
        }
    }
?>