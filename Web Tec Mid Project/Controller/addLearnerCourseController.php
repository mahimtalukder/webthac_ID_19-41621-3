<?php

class addLearnerCourse{
    public $error="";

    function add_course($data){

        require_once "get_courseController.php";
        $obj=new course();
        $learner=$obj->get_leaarnerCourse($data["username"]);

        if(!empty($learner)){
            $has_course=array();
            $has_course=$learner["course"];
    
            foreach($has_course as $need){
                if($need==$data["course"]){
                    $this->error="You alrady take this course!";
                    return;
                }
            }
    
            array_push($has_course,$data["course"]);

            $courseArr=array(
                'username'=> $data["username"],
                'course' => $has_course
            );

            require_once "C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/course_model.php";
            $obj2=new courseModel();

            return $obj2->updateCourse($courseArr);   
        }
        else{
            $has_course=array();
            array_push($has_course,$data["course"]);

            $courseArr=array(
                'username'=> $data["username"],
                'course' => $has_course
            );

            require_once "C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/course_model.php";
            $obj2=new courseModel();

            return $obj2->addNewCourse($courseArr);
        }
    }

    function get_error(){
        return $this -> error;
    }
}
?>
