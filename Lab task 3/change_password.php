<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>
        Sign in
    </title>
</head>

<body class="background_color">
    <?php
    $usernameErr=$passwordErr=$confirm_passwordErr=$new_passwordErr=$message= "";
     $password=$new_password  = $confirm_password="";
    $mypassword="Mahim@123";
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password= $_POST["password"];
        $new_password= $_POST["new_password"];
        $confirm_password= $_POST["confirm_password"];



        if (empty($password)) {
            $passwordErr = "Password is required";
        }
        else
        {
            if (strlen($password)<9) {
                $passwordErr = "Password must contain at least 8 character";
            }
            else{

                if(preg_match('/[#$%@]/', $password)!==1){
                    $passwordErr = "Password have to contain at least one '#' or '$' or '%' or '@'";
                }
                else{
                    if(strcmp($password,$mypassword)!==0){
                        $passwordErr="Password not mached";
                    }
                    else{
                        if (empty($new_password)) {
                            $new_passwordErr = "Password is required";
                        }
                        else
                        {
                            if (strlen($new_password)<9) {
                                $new_passwordErr = "Password must contain at least 8 character";
                            }
                            else{
                
                                if(preg_match('/[#$%@]/', $new_password)!==1){
                                    $new_passwordErr = "Password have to contain at least one '#' or '$' or '%' or '@'";
                                }
                            }
                        }
            
                        if (empty($confirm_password)) {
                            $confirm_passwordErr = "Confirm Password is required";
                        }
                        else
                        {
                            if (strcmp($new_password,$confirm_password)!==0) {
                                $confirm_passwordErr = "Password are not matched";
                            }
                        }
                    }
                }
            }
        }


        if(empty($new_passwordErr) && empty($passwordErr) && empty($confirm_passwordErr)){
            $mypassword=$new_password;
            $message="Passaword changed";
        }
      
    }
    ?>


    <div class="header">
        <p class="logo"><?php include 'header.php'; ?></p>
        <div class="header-right">
        <a class="active" href="login.php">Login</a>
        <a href="#home">Home</a>
        <a href="Registration.php">Registration</a>
        </div>

    </div>

    <div class="outer_box">
        <div class="inerBox">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Change Password</h1>

                <legend class="legend_style">Current Password:</legend>
                <div class="user_name">
                    <input type="password" name="password" id="password" class="input_style_password" value="<?php echo $password; ?>">
                </div>
                <input type="checkbox" onclick="myFunction()"><label class="label1">Show Password</label><br>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($passwordErr) {
                        echo ($passwordErr);
                    }
                    ?>
                </span>

                <legend class="legend_style">New Password:</legend>
                <div class="user_name">
                    <input type="password" name="new_password" id="password1" class="input_style_password" value="<?php echo $new_password; ?>">
                </div>
                <input type="checkbox" onclick="myFunction1()"><label class="label1">Show Password</label><br>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($new_passwordErr) {
                        echo ($new_passwordErr);
                    }
                    ?>
                </span>

                <legend class="legend_style">Confirm Password:</legend>
                <div class="user_name">
                    <input type="password" name="confirm_password" id="confirm_password" class="input_style_password" value="<?php echo $confirm_password; ?>">
                </div>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($confirm_passwordErr) {
                        echo ($confirm_passwordErr);
                    }
                    ?>
                </span>


                <div class="button">
                    <input type="submit" class="submit_button" value="Submit">
                </div>
                <div style="color:green;text-align: center;" class="button">
                <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                ?>
               </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                 x.type = "password";
                }
        }

        function myFunction1() {
            var x = document.getElementById("password1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                 x.type = "password";
                }
        }
    </script>
</body>

</html>