<?php
    class admin extends conectMV{
        function show(){
            //model

            //view
            $vi = $this->view("layout-admin", ["page"=>"home"]);
        }

        function students(){
            $this->view("layout-admin", ["page"=>"students"]);
        }

        function lecturers(){
            $this->view("layout-admin", ["page"=>"lecturers"]);
        }

        function thesistopic(){
            $this->view("layout-admin", ["page"=>"thesistopic"]);
        }
    }
?>