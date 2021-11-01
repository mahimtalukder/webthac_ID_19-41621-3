<?php

class update{

    public $error=array(
        'nameErr'=>"",
        'emailErr' =>"",
        'dobErr' =>"",
        'genderErr' =>"",
    );
    public $message="";

    function update_learner($data)
    {
      if (empty($data["name"])) {
          $this-> error["nameErr"] = "Name is required";
      } else {
          if ((str_word_count($data["name"])) < 2) {
            $this-> error["nameErr"] = "The name must have at least two word";
          } else {
              if ((preg_match("/[A-Za-z]/", $data["name"][0])) == 0) {
                $this-> error["nameErr"] = "The name must have start with litter";
              } else {
                  if (preg_match('/^[A-Za-z\s._-]+$/', $data["name"]) !== 1) {
                    $this-> error["nameErr"] = "Name can contain letter,desh,dot and space";
                  }
              }
          }
      }
  

      if (empty($data["email"])) {
        $this-> error["emailErr"] = "Email is required";
      } else {
          if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this-> error["emailErr"] = "Invalid email format";
          }
          else{
            require_once "C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/model.php";
            $check_mail=new model();

            if($check_mail->update_verify_unique_email($data["email"],$data["username"])==false){
                $this-> error["emailErr"] = "Email already exists";
            }
          }
      }

      if (empty($data["dob"])) {
        $this-> error["dobErr"] = "Date of Birth required";
      } else {
          if ($data["dob"] > date('Y-m-d')) {
            $this-> error["dobErr"] = "Invalide input";
          }
      }
  
      if (empty($data["gender"])){
        $this-> error["genderErr"] = "Gender is required";
      }
  
      if (empty($this-> error["nameErr"]) && empty($this-> error["emailErr"]) && empty($this-> error["dobErr"]) && empty($this-> error["genderErr"])) {
        require_once "C:/xampp/htdocs/Fall21_22/Web Tec Mid Project/model/model.php";
        $create_account=new model();

        $this->message=$create_account->update_learner($data);
      }
  
  
    }

    function get_error(){
        return $this -> error;
    }

    function get_messege(){
        return $this -> message;
    }
}
?>