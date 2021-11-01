<?php
   class model{
       public $username="";
       public $message="";

       function db_conn()
      {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";

        try {
            $conn = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        return $conn;
       }

    function create_learner($data){

        $conn = $this->db_conn();
        $selectQuery = 'SELECT * FROM `learner`';
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo "create_1 ".$e->getMessage();
        }
        $student_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(empty($student_data)){
            $username=date("y")."-"."10001"."-".date("m");
        }
        else{
            foreach ($student_data as $row) {
                $arr=explode("-",$row["username"]);
            }
            $id_mid=(int)$arr[1];
            $id_change=$id_mid+1;
            $username= date("y")."-".$id_change."-".date("m");
        }

        $selectQuery = "INSERT into learner (name, email, username,password, dob,gender, picture)
        VALUES (:name, :email, :username,:password, :dob, :gender, :picture)";
            try{
                $stmt = $conn->prepare($selectQuery);
                $stmt->execute([
                    ':name'               =>     $data["name"],
                    ':email'          =>      $data["email"],
                    ':username'     =>     $username,
                    ':password'     =>     $data["password"],
                    ':dob'     =>      $data["dob"],
                    ':gender'     =>      $data["gender"],
                    ':picture' => "broken.png"
                ]);
            }catch(PDOException $e){
                echo "create_2 ".$e->getMessage();
            }
            
            $conn = null;
            return ("<label class='text-success'>Account Created<br>Your ID: ".$username."</p>");
    }

    function get_a_learner($id){

        $conn = $this->db_conn();
        $selectQuery = "SELECT * FROM `learner` where username = ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if(!empty($row)){
            return $row;
        }
        return "";
    }

    function verify_id_password($id,$password){
        $conn = $this->db_conn();
        $selectQuery = "SELECT * FROM `learner` where username = ? AND password= ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id,$password]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if(!empty($row)){
            return $row;
        }
        return "";
    }

    function verify_unique_email($email){
        $conn = $this->db_conn();
        $selectQuery = 'SELECT * FROM `learner`';
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $student_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
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
        $conn = $this->db_conn();
        $selectQuery = 'SELECT * FROM `learner`';
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        $student_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
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

        $conn = $this->db_conn();
        $selectQuery = "UPDATE learner set name = ?, email = ?, dob = ?, gender = ? where username = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $learner['name'], $learner['email'], $learner['dob'], $learner['gender'],$learner['username']
            ]);
        }catch(PDOException $e){
            echo "Update ".$e->getMessage();
        }
        $conn = null;
        return "Information changed!";
       }

       function change_picture($learner){

        $conn = $this->db_conn();
        $selectQuery = "UPDATE learner set picture = ? where username = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $learner['filepath'], $learner['username']
            ]);
        }catch(PDOException $e){
            echo "change picture  ".$e->getMessage();
        }
        $conn = null;
       }

       function change_password($learner){

        $conn = $this->db_conn();
        $selectQuery = "UPDATE learner set password = ? where username = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $learner['new_password'], $learner['username']
            ]);
        }catch(PDOException $e){
            echo "change password  ".$e->getMessage();
        }
        $conn = null;
       }

       function delete_learner($id){
        $conn = $this->db_conn();
        $selectQuery = "DELETE FROM `learner` WHERE `username` = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        }catch(PDOException $e){
            echo "Delete learner ".$e->getMessage();
        }
        $conn = null;
       }
   }
?>