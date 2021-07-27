<?php
    class thesis extends conectMV{
        function show(){
            //model

            //view
            $vi = $this->view("layout", ["page"=>"home"]);
        }

        function thesislist(){
            $this->view("layout", ["page"=>"thesislist"]);
        }

        function thesisregister(){
            $this->view("layout", ["page"=>"thesisregister"]);
        }
    }
?>