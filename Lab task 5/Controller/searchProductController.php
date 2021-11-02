<?php

class search{

    public $error="";

    function search_product($key){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 5/model/model.php";
        $obj=new model();
        if(empty($key)){
            $this->error="Type anythink";
        }

        if(empty($this->error)){
            return $obj->searchProduct($key);
        }
        else{
            return "";
        }
    }

    function get_error(){
        return $this->error;
    }
}
?>