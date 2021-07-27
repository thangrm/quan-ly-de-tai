<?php
    class account extends conectMV{
        function show(){
            //model

            //view
            $vi = $this->view("layout", ["page"=>"home"]);
        }

        function profile(){
            $this->view("layout", ["page"=>"profile"]);
        }

        function password(){
            $this->view("layout", ["page"=>"password"]);
        }
    }
?>