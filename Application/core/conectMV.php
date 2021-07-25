<?php
class conectMV{
    
    function model($model)
    {
        require_once "./Application/models/".$model.".php";
        return new $model;
    }
    function view($view,$data=[])
    {
        require_once "./Application/views/".$view.".php";
    }
}
?>