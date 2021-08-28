<?php
    class logout extends conectMV{
        function show(){
            //model

            //view
            unset($_SESSION['login']);
            header('Location: '.getUrl('login'));
        }
    }
?>