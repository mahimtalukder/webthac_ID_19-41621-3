<?php
class student_info{
    function get_learner($id){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 6/model/model.php";
        $learner=new model();

        return $learner->get_a_learner($id);
    }
}
?>