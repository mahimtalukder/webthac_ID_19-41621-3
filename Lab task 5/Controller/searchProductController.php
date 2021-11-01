<?php

class search{

    function search_product($key){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 5/model/model.php";
        $obj=new model();

        return $obj->searchProduct($key);
    }
}
?>