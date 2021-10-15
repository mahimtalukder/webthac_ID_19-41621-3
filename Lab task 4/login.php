<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>
        Sign in
    </title>
</head>

<body class="background_color">
    <?php
    session_start();
    $time = time();
    $usernameErr = $passwordErr = $confirm_passwordErr = "";
    $username = $password  = "";
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username =  test_input($_POST["username"]);
        $password = $_POST["password"];


        if (empty($username)) {
            $usernameErr = "Username is required";
        } else {
            if (strlen($username) < 3) {
                $usernameErr = "Username must contain at least 2 character";
            } else {
                if (preg_match('/^[A-Za-z0-9\s.-]+$/', $username) !== 1) {
                    $usernameErr = "Username can contain letter, number, dot and desh";
                }
            }
        }

        if (empty($password)) {
            $passwordErr = "Password is required";
        } else {
            if (strlen($password) < 9) {
                $passwordErr = "Password must contain at least 8 character";
            } else {

                if (preg_match('/[#$%@]/', $password) !== 1) {
                    $passwordErr = "Password have to contain at least one '#' or '$' or '%' or '@'";
                }
            }
        }

        $username_found = false;
        $data = file_get_contents("data.json");
        $data = json_decode($data, true);

        if (empty($passwordErr) && empty($usernameErr) && !empty($data)) {
            foreach ($data as $row) {
                if ($row["username"] == $username) {
                    $username_found = true;
                    if ($row["password"] == $password) {
                        $_SESSION['username'] = $row["username"];
                        $_SESSION['password'] = $row["password"];
                        $_SESSION['name'] = $row["name"];
                        $_SESSION['email'] = $row["email"];
                        $_SESSION['dob'] = $row["dob"];
                        $_SESSION['gender'] = $row["gender"];
                        $_SESSION['picture'] = $row["picture"];
                        header("location: Dashbord.php");
                    } else {
                        $passwordErr = "password incorrect";
                    }
                    break;
                }
            }
            if ($username_found == false) {
                $usernameErr = "username does not exist";
            }
        }
        if (empty($data)) {
            $usernameErr = "username does not exist";
        }

        if (!empty($_POST['remember'])) {
            setcookie("username", $_POST['username'], time() + 10);
            setcookie("password", $_POST['password'], time() + 10);
        }
    }
    ?>


    <div class="header">
        <p class="logo"><?php include 'header.php'; ?></p>
        <div class="header-right">
            <a class="active" href="login.php">Login</a>
            <a href="Home.php">Home</a>
            <a href="Registration.php">Registration</a>
        </div>

    </div>

    <div class="outer_box">
        <div class="inerBox" style="width:300px;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Sign In</h1>

                <legend class="legend_style">User Name:</legend>
                <div class="user_name">
                    <input type="text" name="username" id="username" class="input_style" placeholder="abcd" value="<?php if (isset($_COOKIE['username'])) {
                                                                                                                        echo $_COOKIE['username'];
                                                                                                                    } else {
                                                                                                                        echo $username;
                                                                                                                    } ?>">
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
                    <input type="password" name="password" id="password" class="input_style_password" placeholder="1234@854845" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                            echo $_COOKIE['password'];
                                                                                                                                        } else {
                                                                                                                                            echo $password;
                                                                                                                                        } ?>">
                </div>
                <input type="checkbox" onclick="myFunction()"><label class="label1">Show Password</label><br>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($passwordErr) {
                        echo ($passwordErr);
                    }
                    ?><br>
                </span>
                <a class="forgot_password" href="forget_password.php">Forgot Password?</a>
                <input type="checkbox" name="remember" <?php if (isset($_COOKIE['password'])) {
                                                            echo "checked";
                                                        } ?>><label class="label1">Remember me</label><br>


                <div class="button">
                    <input type="submit" class="submit_button" value="Submit">
                </div>
            </form>
            <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                <?php
                if (isset($message)) {
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