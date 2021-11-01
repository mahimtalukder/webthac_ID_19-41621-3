<?php

class getInfo{

    function get(){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 5/model/model.php";
        $obj=new model();

        return $obj->get_info();
    }

    function get_a_product($name){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 5/model/model.php";
        $obj=new model();
        return $obj->get_a_product($name);
    }
}
?>