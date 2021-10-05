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
    $usernameErr=$passwordErr=$confirm_passwordErr= "";
    $username = $password  = "";
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username=  test_input($_POST["username"]);
        $password= $_POST["password"];


        if (empty($username)) {
            $usernameErr = "Username is required";
        } else {
            if (strlen($username)<3) {
                $usernameErr = "Username must contain at least 2 character";
            }
            else{
                if(preg_match('/^[A-Za-z0-9\s.-]+$/', $username) !== 1){
                    $usernameErr = "Username can contain letter, number, dot and desh";
                }
                else{
                    $data = file_get_contents("data.json");  
                    $data = json_decode($data, true);  
                    foreach($data as $row)  
                    {
                        if($row["username"]==$username){
                            $usernameErr="Username already exists";
                            break;
                        }       
                    } 
                }
            }
        }

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
            }
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
                <h1>Sign In</h1>

                <legend class="legend_style">User Name:</legend>
                <div class="user_name">
                    <input type="text" name="username" id="username" class="input_style" placeholder="abcd" value="<?php echo $username; ?>">
                </div>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($usernameErr) {
                        echo ($usernameErr);
                    }
                    ?>
                </span>

                <legend class="legend_style">Password:</legend>
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
                <a class="forgot_password" href="">Forgot Password?</a>


                <div class="button">
                    <input type="submit" class="submit_button" value="Submit">
                </div>
            </form>
            <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                ?>
                </span>
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
    </script>
</body>

</html>