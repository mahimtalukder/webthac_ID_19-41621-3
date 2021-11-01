<?php
class courseModel{
    function getAllCourse(){
        $course = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/course.json");
        $course = json_decode($course, true);
        return $course;
    }

    function get_course($id){
        $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/takenCourse.json");
        $student_data = json_decode($student_data, true);
        if (!empty($student_data)) {
            foreach ($student_data as $row) {
                if ($row["username"] == $id) {
                  return $row;
                }
            }
        }
        return "";
    }

    function addNewCourse($data){
        if (file_exists('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/takenCourse.json')) {
            $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/takenCourse.json");
            $student_data = json_decode($student_data, true);
            
              $current_data = file_get_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/takenCourse.json');
              $array_data = json_decode($current_data, true);
              $extra = array(
                  'username'               =>     $data["username"],
                  'course'          =>      $data["course"],
              );
              $array_data[] = $extra;
              $final_data = json_encode($array_data);
              if (file_put_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/takenCourse.json', $final_data)) {
                return "Course Added!";
              }
          }
    }

    function updateCourse($learner){
        $data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/takenCourse.json");
        $data = json_decode($data, true);
        foreach ($data as $row) {
            if ($row["username"] == $learner["username"]) {
                $data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/takenCourse.json");
                $data = json_decode($data, true);
                if (!empty($data)) {
                    foreach ($data as $key => $row) {
                        if ($row["username"] == $learner["username"]) {
                            $data[$key]['course'] = $learner["course"];
    
    
                            $this-> message = "Course Added!";
                            break;
                        }
                    }
    
                    file_put_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/takenCourse.json', json_encode($data));
                }
                break;
            }
        }
        return $this->message;
    }

    function get_learnerProgress($data){
        $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/student_progress.json");
        $student_data = json_decode($student_data, true);
        if (!empty($student_data)) {
            foreach ($student_data as $row) {
                if ($row["username"] == $data["username"] && $row["course"]=$data["course"]) {
                  return $row;
                }
            }
        }
        return "";
    }

    function get_lacture($data){
        $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/lacture.json");
        $student_data = json_decode($student_data, true);
        if (!empty($student_data)) {
            foreach ($student_data as $row) {
                if ($row["name"] == $data["name"] && $row["course"]==$data["course"]) {
                  return $row;
                }
            }
        }
        return "";
    }

    function get_quiz($data){
        $quiz=array();
        $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/quiz.json");
        $student_data = json_decode($student_data, true);
        if (!empty($student_data)) {
            foreach ($student_data as $row) {
                if ($row["quiz_no"] == $data["quiz_no"] && $row["course"]==$data["course"]) {
                    array_push($quiz,$row);
                }
            }
        }
        return $quiz;
    }

    function addNewProgress($data){
        if (file_exists('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/student_progress.json')) {
            $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/student_progress.json");
            $student_data = json_decode($student_data, true);
            
              $current_data = file_get_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/student_progress.json');
              $array_data = json_decode($current_data, true);
              $extra = array(
                  'username'               =>     $data["username"],
                  'course'          =>      $data["course"],
                  'lacture'          =>      $data["lacture"],
              );
              $array_data[] = $extra;
              $final_data = json_encode($array_data);
              if (file_put_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/student_progress.json', $final_data)) {
               
              }
          }
    }

    function updateProgress($learner){
        $data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/student_progress.json");
        $data = json_decode($data, true);
        foreach ($data as $row) {
            if ($row["username"] == $learner["username"]) {
                $data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/student_progress.json");
                $data = json_decode($data, true);
                if (!empty($data)) {
                    foreach ($data as $key => $row) {
                        if ($row["username"] == $learner["username"] && $row["course"] == $learner["course"]) {
                            $data[$key]['lacture'] = $learner["lacture"];
                            break;
                        }
                    }
    
                    file_put_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/student_progress.json', json_encode($data));
                }
                break;
            }
        }
    }
}
?>