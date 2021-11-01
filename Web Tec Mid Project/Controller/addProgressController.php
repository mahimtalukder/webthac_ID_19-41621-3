<?php

class progressAdder{

    function add_Newprogress($data){
        require_once "C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/course_model.php";
        $obj=new courseModel();
        return $obj->addNewProgress($data);
    }

    function add_Updateprogress($data){
        require_once "C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/course_model.php";
        $obj=new courseModel();
        return $obj->updateProgress($data);
    }
}
?>
