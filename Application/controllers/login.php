<?php
    class login extends conectMV{
        function show(){
            //model

            //view
            if($this->role == $this->ROLE_GUEST){
                $this->view("login");
            }else{
                header('Location: '.getUrl('home'));
            }

        }
    }
?>