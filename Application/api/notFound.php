<?php
    class notFound extends API{
        function __construct(){
            parent::__construct();
        }
    
        function error(){
            echo $this->responseStatus(404); 
        }
    }
?>