<?php

class progress{

    function get_progess($data){
        require_once "C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/course_model.php";
        $obj=new courseModel();
        return $obj->get_learnerProgress($data);
    }
}

?>