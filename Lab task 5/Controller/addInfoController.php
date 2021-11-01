<?php

class add{

    public $error=array(
        'nameErr'=>"",
        'buying_priceErr' =>"",
        'selling_priceErr' =>""
    );

    function add_info($data){


        if (empty($data["name"])){
            $this-> error["nameErr"] = "Name is required";
        }
        else{
            require_once "C:/xampp/htdocs/Fall21_22/Lab task 5/model/model.php";
            $obj=new model();

            if($obj->verify_unique_name($data["name"])==false){
                $this-> error["nameErr"] = "Name already exists";
            }
        }

        if (empty($data["buying_price"])){
            $this-> error["buying_priceErr"] = "Buying price is required";
        }

        if (empty($data["selling_price"])){
            $this-> error["selling_priceErr"] = "Selling price is required";
        }

        if(empty($this-> error["nameErr"]) && empty($this-> error["buying_priceErr"])  && empty($this-> error["selling_priceErr"]) ){

            require_once "C:/xampp/htdocs/Fall21_22/Lab task 5/model/model.php";
            $obj=new model();

            $obj->insert_info($data);
            return "Information added";

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