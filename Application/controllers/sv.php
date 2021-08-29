<?php
    class sv extends conectMV{
        function show(){
            //model

            //view
            if($this->role != $this->ROLE_SINHVIEN){
                header('Location: '.getUrl('home'));
            }
            $vi = $this->view("layout-sv", ["page"=>"home"]);
        }

        function account($param){
            if($this->role != $this->ROLE_SINHVIEN){
                header('Location: '.getUrl('home'));
            }

            if($param == "") {
                $this->view("layout-sv", ["page"=>"home"]);
            }

            if($param == "profile") {
                $this->view("layout-sv", ["page"=>"profile"]);
            }

            if($param == "password") {
                $this->view("layout-sv", ["page"=>"password"]);
            }
        }

        function thesis($param){
            if($this->role != $this->ROLE_SINHVIEN){
                header('Location: '.getUrl('home'));
            }

            if($param == "") {
                $this->view("layout-sv", ["page"=>"home"]);
            }

            if($param == "thesislist") {
                $this->view("layout-sv", ["page"=>"thesislist"]);
            }

            if($param == "thesisregister") {
                $this->view("layout-sv", ["page"=>"thesisregister"]);
            }

            if($param == "thesissample") {
                $this->view("layout-sv", ["page"=>"thesissample"]);
            }

            if($param == "thesistracking") {
                $this->view("layout-sv", ["page"=>"thesistracking"]);
            }
        }

        function group($param){
            if($this->role != $this->ROLE_SINHVIEN){
                header('Location: '.getUrl('home'));
            }
            
            if($param == "show") {
                $this->view("layout-sv", ["page"=>"group"]);
            }

            if($param == "viewassignment") {
                $this->view("layout-sv", ["page"=>"viewassignment"]);
            }
        }
    }
?>