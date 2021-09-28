<?php
$name = $email = $gender = $comment = $website = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $dobd = test_input($_POST["dobd"]);
    $dobm = test_input($_POST["dobm"]);
    $doby = test_input($_POST["doby"]);
    $gender = test_input($_POST["gender"]);
    $degree1 = test_input($_POST["degree1"]);
    $degree2 = test_input($_POST["degree2"]);
    $degree3 = test_input($_POST["degree3"]);
    $degree4 = test_input($_POST["degree4"]);
  

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if(empty($name)){
      $nameErr="Name is required";
      if((str_word_count($name))<2){
        $nameErr="The name must have at least two word";
        if(!preg_match("/[A-Za-z]/", $str[0])){
            $nameErr="The name must have start with litter";  
        }
      }
  }
}

?>