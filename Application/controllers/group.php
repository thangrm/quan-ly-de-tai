<?php
    class group extends conectMV{
        function show(){
            //model

            //view
            $vi = $this->view("layout", ["page"=>"home"]);
        }

        function group(){
            $this->view("layout", ["page"=>"group"]);
        }

        function viewassignment(){
            $this->view("layout", ["page"=>"viewassignment"]);
        }
    }
?>