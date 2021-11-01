<?php
class course{

    function get_couse(){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 5/model/course_model.php";
        $obj=new courseModel();
        return $obj->getAllCourse();
    }

    function get_leaarnerCourse($id){
        require_once "C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/course_model.php";
        $obj=new courseModel();
        return $obj->get_course($id);
    }
}
?>