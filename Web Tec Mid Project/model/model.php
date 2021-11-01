<?php
   class model{
       public $username="";
       public $message="";

    function create_learner($data){
        if (file_exists('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json')) {
            $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
            $student_data = json_decode($student_data, true);
            if (!empty($student_data)) {
                $count=0;
                foreach ($student_data as $row) {
                    $count=$count+1;
                }
                $id_change=10001+$count;
                $username= date("y")."-".$id_change."-".date("m");
                
            }
            else{
                $username=date("y")."-"."10001"."-".date("m");
            }
            
              $current_data = file_get_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json');
              $array_data = json_decode($current_data, true);
              $extra = array(
                  'name'               =>     $data["name"],
                  'email'          =>      $data["email"],
                  'username'     =>     $username,
                  'password'     =>     $data["password"],
                  'dob'     =>      $data["dob"],
                  'gender'     =>      $data["gender"],
                  'picture' => "broken.png"
              );
              $array_data[] = $extra;
              $final_data = json_encode($array_data);
              if (file_put_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json', $final_data)) {
                return ("<label class='text-success'>Account Created<br>Your ID: ".$username."</p>");
              }
          } else {
            return 'JSON File does not exist';
          }
    }

    function get_a_learner($id){
        $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
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

    function verify_id_password($id,$password){
        $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
        $student_data = json_decode($student_data, true);
        if (!empty($student_data)) {
            foreach ($student_data as $row) {
                if ($row["username"] == $id && $row["password"] == $password) {
                  return $row;
                }
            }
        }
        return "";
    }

    function verify_unique_email($email){
        $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
        $student_data = json_decode($student_data, true);
        if (!empty($student_data)) {
            foreach ($student_data as $row) {
                if ($row["email"] == $email) {
                  return false;
                }
            }
        }
        return true;
    }

    function update_verify_unique_email($email,$id){
        $student_data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
        $student_data = json_decode($student_data, true);
        if (!empty($student_data)) {
            foreach ($student_data as $row) {
                if ($row["username"] != $id && $row["email"] == $email) {
                  return false;
                }
            }
        }
        return true;
       }
    
       function update_learner($learner){
        $data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
        $data = json_decode($data, true);
        foreach ($data as $row) {
            if ($row["username"] == $learner["username"]) {
                $data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
                $data = json_decode($data, true);
                if (!empty($data)) {
                    foreach ($data as $key => $row) {
                        if ($row["username"] == $learner["username"]) {
                            $data[$key]['name'] = $learner["name"];

                            $data[$key]['email'] = $learner["email"];
     
                            $data[$key]['dob'] = $learner["dob"];
    
                            $data[$key]['gender'] = $learner["gender"];
    
                            $this-> message = "Information changed!";
                            break;
                        }
                    }
    
                    file_put_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json', json_encode($data));
                }
                break;
            }
        }
        return $this->message;
       }

       function change_picture($learner){
        $data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
        $data = json_decode($data, true);
        if (!empty($data)) {
            foreach ($data as $key => $row) {
                if ($row["username"] == $learner['username']) {
                    $data[$key]['picture'] = $learner["filepath"];
                    break;
                }
            }

            file_put_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json', json_encode($data));
        }
       }

       function change_password($learner){
        $data = file_get_contents("C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json");
        $data = json_decode($data, true);
        if (!empty($data)) {
            foreach ($data as $key => $row) {
                if ($row["username"] == $learner["username"]) {
                    $data[$key]['password'] = $learner["new_password"];
                    break;
                }
            }

            file_put_contents('C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/data.json', json_encode($data));
       }
       }
   }
?>