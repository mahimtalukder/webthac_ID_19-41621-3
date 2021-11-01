<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Dashboard</title>
</head>
<?php
    session_start();
    $time = time();
    $usernameErr = $passwordErr = "";
    $username = $password = "";
    $student="";
    $data=[];
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $password = $_POST["password"];


        $data= array(
            'username'=> $username,
            'password'=>$password,
        );


        require_once "Controller/loginController.php";
        $learner= new addstudent();

        $student=$learner->found_learner($data);

        $error=$learner->get_error();

        $usernameErr=$error["usernameErr"];
        $passwordErr=$error["passwordErr"];

        

        if (empty($passwordErr) && empty($usernameErr) && $student!="") {
            $_SESSION['username'] = $student["username"];
            $_SESSION['password'] = $student["password"];
            header("location: dashboard.php");
        }

        if (!empty($_POST['remember'])) {
            setcookie("username", $_POST['username'], time() + 10);
            setcookie("password", $_POST['password'], time() + 10);
        }

    }
    ?>


<body>
    <div class="split-screen">
        <?php include 'client_header.php'; ?>
        <div style="margin: 0;display: flex;justify-content: center;align-items: center; padding: 10px; font-size: 25px; font-weight: 500;">
            <div style=" width: 350px; background: #fff;display: flex;padding-left: 50px;box-shadow: -2px 2px 20px #696969;border-radius: 15px;">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">        
                    <div class="user_name">
                        <legend class="legend_style1">ID:</legend>
                        <input type="text" name="username" id="username" class="input_style" placeholder="xx-xxxxx-xx" value="<?php if (isset($_COOKIE['username'])) {
                                                                                                                        echo $_COOKIE['username'];
                                                                                                                    } else {
                                                                                                                        echo $username;
                                                                                                                    } ?>">
                        <br>
                        <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <?php
                            if ($usernameErr) {
                                echo ($usernameErr);
                            }
                            ?>
                        </span>
                    </div>

        
                    <legend class="legend_style">Password:</legend>
                    <div class="user_name">
                    <input type="password" name="password" id="password" class="input_style_password" placeholder="1234@854845" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                            echo $_COOKIE['password'];
                                                                                                                                        } else {
                                                                                                                                            echo $password;
                                                                                                                                        } ?>">
                    </div>
                    <input type="checkbox" onclick="myFunction()"><label class="label1">Show Password</label>
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                        <br>
                        <?php
                        if ($passwordErr) {
                            echo ($passwordErr);
                        }
                        ?>
                    </span>
                    <br>
                <input type="checkbox" name="remember" <?php if (isset($_COOKIE['password'])) {
                                                            echo "checked";
                                                        } ?>><label class="label1">Remember me</label><br>

                    <div class="button">
                        <input type="submit" class="submit_button" value="Login">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php include 'client_footer.php'; ?>
    </div>
</body>

</html>
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