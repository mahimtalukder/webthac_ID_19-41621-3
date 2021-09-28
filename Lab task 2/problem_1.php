<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="need.css">
        <title>
            Task 2
        </title>
    </head>

    <body class=background_color>
    <?php
    $nameErr = $emailErr = $genderErr = $dobErr =$degreeErr=$blood_groupErr= "";
    $name = $email = $gender = $dobd = $dobm = $doby = $degree1 = $degree2 = $degree3 =  $degree4 =$blood_group= "";
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $name = test_input($_POST["name"]);
       $email = test_input($_POST["email"]);
       $dobd = (int)test_input($_POST["dobd"]);
       $dobm = (int)test_input($_POST["dobm"]);
       $doby = (int)test_input($_POST["doby"]);
  

        if(empty($name)){
            $nameErr="Name is required";  
       }
       else{
        if((str_word_count($name))<2){
            $nameErr="The name must have at least two word";
        }
        else{
            if((preg_match("/[A-Za-z]/", $name[0]))==0){
                $nameErr="The name must have start with litter";  
            }
            else
            {
                if(preg_match( '/^[A-Za-z\s._-]+$/', $name)!==1){
                    $nameErr="Name can contain letter,desh,dot and space";  
                }
            }
        }
       }

       if (empty($email)) {
          $emailErr = "Email is required";
       } 
       else {
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
      }

      if((empty($dobd)) || (empty($dobm)) || (empty($doby)))
      {
          $dobErr="Date of Birth required";
      }
      else{
          if($dobd>0 and $dobd<32){
            if($dobm>0 and $dobm<13){
                if($doby>1952 and $doby<1999){}
                else{
                    $dobErr="Year must be in between 1953-1998";
                }
            }
            else{
                $dobErr="Month must be in between 1-12";
            }
          }
          else{
            $dobErr="Date must be in between 1-31";  
          }
      }

      if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
      } else {
        $gender = test_input($_POST["gender"]);
      }


      $str = "4";
      $count = (int)$str;
      
      if(empty($_POST["degree1"])){
        $count=$count-1;
      }
      else{
          $degree1=test_input($_POST["degree1"]);
      }


      if(empty($_POST["degree2"])){
        $count=$count-1;
      }
      else{
        $degree2=test_input($_POST["degree2"]);
      }


      if(empty($_POST["degree3"])){
        $count=$count-1;
      }
      else{
        $degree3=test_input($_POST["degree3"]);
      }


      if(empty($_POST["degree4"])){
        $count=$count-1;
      }
      else{
        $degree4=test_input($_POST["degree4"]);
      }

      if($count<2)
      {
          $degreeErr="Need to select at least two degree.";
      }

      if (empty($_POST["blood_group"])) {
        $blood_groupErr = "Blood Group is required";
      } else {
        $blood_group = test_input($_POST["blood_group"]);
      }
    }
   ?>
        <div class="outer_box">
            <div class="inerBox">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <h1>Enter Your Information</h1>

                    <div class="name_email">
                        <div class="name">
                            <legend class="legend_style1">Name:</legend>
                            <input type="text" id="name" name="name" class="input_style" placeholder="Mr. example" value="<?php echo $name;?>">
                            <br>
                            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <?php
                               if($nameErr){
                                   echo($nameErr);
                               }
                            ?>
                            </span>
                        </div>
    
                        <div class="email">
                            <legend class="legend_style1">Email:</legend>
                            <input type="text" id="email" name="email" class="input_style" placeholder="someone@example.com" value="<?php echo $email;?>">
                            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <br>
                            <?php
                               if($emailErr){
                                   echo($emailErr);
                               }
                            ?>
                            </span>
                        </div>
                    </div>
                    

                    <table border=0>
                        <tr>
                            <td class="td1">
                                <legend class="legend_style">Date of Birth:</legend>
                    <div class="dob">
                        <div class="dobd">
                            &nbsp<label>dd</label><br>
                            <input type="text" class="input_style1" name="dobd" value="<?php if($dobd==0){}else{echo $dobd;}?>"/><span> / </span>
                        </div>
                        
                        <div class="dobm">
                            &nbsp&nbsp<label>mm</label><br>
                            &nbsp <input type="text" class="input_style1"  name="dobm" value="<?php if($dobm==0){}else{echo $dobm;}?>"/><span> / </span>
                         </div>
                
                        <div class="doby">
                            &nbsp &nbsp<label>yyyy</label><br>
                          &nbsp <input type="text" class="input_style1" style="width:50px;" name="doby" value="<?php if($doby==0){}else{echo $doby;}?>"/>
                        </div>

                    </div>
                    
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <?php
                               if($dobErr){
                                   echo($dobErr);
                               }
                            ?>
                            </span>

                    <div class="gender">
                        <Legend class="legend_style">Gender:</Legend>
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">
                        <label for="male">Male</label>&nbsp
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
                        <label for="female">Female</label>&nbsp 
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">
                        <label for="other">Other</label>
                        <hr>
                        <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <?php
                               if($genderErr){
                                   echo($genderErr);
                               }
                            ?>
                            </span>
                    </div>

                    <div class="degree">
                        <legend class="legend_style">Degree:</legend>
                        <input type="checkbox" id="ssc" name="degree1" <?php if (isset($degree1) && $degree1=="ssc") echo "checked";?> value="ssc">
                        <label for="ssc">SSC</label>&nbsp 
                        <input type="checkbox" id="hsc" name="degree2" <?php if (isset($degree2) && $degree2=="hsc") echo "checked";?> value="hsc">
                        <label for="hsc">HSC</label>&nbsp 
                        <input type="checkbox" id="bsc" name="degree3" <?php if (isset($degree3) && $degree3=="bsc") echo "checked";?> value="bsc">
                        <label for="bsc">BSc</label>
                        <input type="checkbox" id="msc" name="degree4" <?php if (isset($degree4) && $degree4=="msc") echo "checked";?> value="msc">
                        <label for="msc">MSc</label>
                        <hr style="width:325px">
                        <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <?php
                               if($degreeErr){
                                   echo($degreeErr);
                               }
                            ?>
                            </span>
                    </div>

                    <div class="Blood Group:">
                        <legend class="legend_style">Blood Group:</legend>
                        <select name="blood_group" style="width:150px;" >
                            <option <?php if (isset($blood_group) && $blood_group==""){ echo ' selected="selected"'; } ?> value="" disabled>Select one</option>
                            <option <?php if (isset($blood_group) && $blood_group=="a+") { echo ' selected="selected"'; } ?> value="a+">A+</option>
                            <option <?php if (isset($blood_group) && $blood_group=="a-") { echo ' selected="selected"'; } ?> value="a-">A-</option>
                            <option <?php if (isset($blood_group) && $blood_group=="b+") { echo ' selected="selected"'; } ?> value="b+">B+</option>
                            <option <?php if (isset($blood_group) && $blood_group=="b-") { echo ' selected="selected"'; } ?> value="b-">B-</option>
                            <option <?php if (isset($blood_group) && $blood_group=="0+") { echo ' selected="selected"'; } ?> value="o+">O+</option>
                            <option <?php if (isset($blood_group) && $blood_group=="o-") { echo ' selected="selected"'; } ?> value="o-">O-</option>
                            <option <?php if (isset($blood_group) && $blood_group=="ab+") { echo ' selected="selected"'; } ?> value="ab+">AB+</option>
                            <option <?php if (isset($blood_group) && $blood_group=="ab-") { echo ' selected="selected"'; } ?> value="ad-">AB-</option>
                        </select>
                        <hr>
                        <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <?php
                               if($blood_groupErr){
                                   echo($blood_groupErr);
                               }
                            ?>
                            </span>
                    </div>
                            </td>
    
                            <td class="td2">
                                <img src="info.svg">
                            </td>
                        </tr>
                        
                    </table>

                    <div class="button">
                        <input type="submit" class="submit_button" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        
    </body>
</html>