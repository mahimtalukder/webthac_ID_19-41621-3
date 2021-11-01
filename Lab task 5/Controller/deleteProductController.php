<?php

class delete{

    function delete_info($name){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 5/model/model.php";
        $obj=new model();
        $obj->delete_product($name);
    }
}
?>