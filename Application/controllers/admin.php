<?php
    class admin extends conectMV{
        function show(){
            //model

            //view
            $vi = $this->view("layout-admin", ["page"=>"home"]);
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