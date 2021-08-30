<?php
    class admin extends conectMV{
        function show(){
            //model

            //view
            $vi = $this->view("layout-admin", ["page"=>"home"]);
        }

        function account($param){
            if($this->role != $this->ROLE_ADMIN){
                header('Location: '.getUrl('home'));
            }

            if($param == "") {
                $this->view("layout-admin", ["page"=>"home"]);
            }

            if($param == "profile") {
                $this->view("layout-admin", ["page"=>"profile"]);
            }

            if($param == "password") {
                $this->view("layout-admin", ["page"=>"password"]);
            }
        }

        function students(){
            if($this->role != $this->ROLE_ADMIN){
                header('Location: '.getUrl('home'));
            }

            $this->view("layout-admin", ["page"=>"students"]);
        }

        function lecturers(){
            if($this->role != $this->ROLE_ADMIN){
                header('Location: '.getUrl('home'));
            }

            $this->view("layout-admin", ["page"=>"lecturers"]);
        }

        function thesistopic(){
            if($this->role != $this->ROLE_ADMIN){
                header('Location: '.getUrl('home'));
            }

            $this->view("layout-admin", ["page"=>"thesistopic"]);
        }
    }
?>