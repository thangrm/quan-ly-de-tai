<?php
    class gv extends conectMV{
        function show(){
            //model

            //view
            $vi = $this->view("layout-gv", ["page"=>"home"]);
        }

        function account($param){
            if($this->role != $this->ROLE_GIAOVIEN){
                header('Location: '.getUrl('home'));
            }

            if($param == "") {
                $this->view("layout-gv", ["page"=>"home"]);
            }

            if($param == "profile") {
                $this->view("layout-gv", ["page"=>"profile"]);
            }

            if($param == "password") {
                $this->view("layout-gv", ["page"=>"password"]);
            }
        }

        function thesis($param){
            if($this->role != $this->ROLE_GIAOVIEN){
                header('Location: '.getUrl('home'));
            }

            if($param == "") {
                $this->view("layout-gv", ["page"=>"home"]);
            }

            if($param == "thesislist") {
                $this->view("layout-gv", ["page"=>"thesislist"]);
            }

            if($param == "createsample") {
                $this->view("layout-gv", ["page"=>"createsample"]);
            }

            if($param == "thesissample") {
                $this->view("layout-gv", ["page"=>"thesissample"]);
            }
        }

        function group($param){
            if($this->role != $this->ROLE_GIAOVIEN){
                header('Location: '.getUrl('home'));
            }

            if($param == "show") {
                $this->view("layout-gv", ["page"=>"group"]);
            }

            if($param == "viewassignment") {
                $this->view("layout-gv", ["page"=>"viewassignment"]);
            }

            if($param == "addgroup") {
                $this->view("layout-gv", ["page"=>"addgroup"]);
            }
        }
    }
?>