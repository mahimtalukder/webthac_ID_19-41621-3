<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>
        Picture
    </title>
</head>

<body class="background_color">
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
		session_destroy();
		header("location:login.php");
	}
    $passwordErr = $new_passwordErr = $username = $confirm_passwordErr = $message = $error = "";
    $password = $new_password = $confirm_password  = "";

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $password = $_POST["password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];




        if (empty($username)) {
            $usernameErr = "Username is required";
        } else {
            if (strlen($username) < 3) {
                $usernameErr = "Username must contain at least 2 character";
            } else {
                if (preg_match('/^[A-Za-z0-9\s.-]+$/', $username) !== 1) {
                    $usernameErr = "Username can contain letter, number, dot and desh";
                } else {
                    $data = file_get_contents("data.json");
                    $data = json_decode($data, true);
                    if (!empty($data)) {
                        foreach ($data as $row) {
                            if ($row["username"] == $username) {
                                $usernameErr = "Username already exists";
                                break;
                            }
                        }
                    }
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
                } else {
                    $data = file_get_contents("data.json");
                    $data = json_decode($data, true);
                    if (!empty($data)) {
                        foreach ($data as $row) {
                            if ($row["username"] == $username && $password != $row["password"]) {

                                $passwordErr = "Invalid password";
                                break;
                            } elseif ($row["username"] == $username && $password == $row["password"]) {
                                if (empty($new_password)) {
                                    $new_passwordErr = "Password is required";
                                } else {
                                    if (strlen($new_password) < 9) {
                                        $new_passwordErr = "Password must contain at least 8 character";
                                    } else {

                                        if (preg_match('/[#$%@]/', $new_password) !== 1) {
                                            $new_passwordErr = "Password have to contain at least one '#' or '$' or '%' or '@'";
                                        } else {
                                            if (empty($confirm_password)) {
                                                $confirm_passwordErr = "Confirm Password is required";
                                            } else {
                                                if (strcmp($new_password, $confirm_password) !== 0) {
                                                    $confirm_passwordErr = "Password are not matched";
                                                } else {
                                                    $data = file_get_contents("data.json");
                                                    $data = json_decode($data, true);
                                                    if (!empty($data)) {
                                                        foreach ($data as $key => $row) {
                                                            if ($row["username"] == $_SESSION['username']) {
                                                                $data[$key]['password'] = $new_password;
                                                                $_SESSION['password'] = $new_password;
                                                                $message = "Password changed!";
                                                                break;
                                                            }
                                                        }

                                                        file_put_contents('data.json', json_encode($data));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ?>


    <div class="header">
        <p class="logo"><?php include 'header.php'; ?></p>
        <div class="header-right">
            <p style="display: flex;color: white;font-size: 18px;"> Log in as: <a class="active" href="#home"><?php if (isset($_SESSION['name'])) {
                                                                                                                    echo $_SESSION['name'];
                                                                                                                } ?></a><a href="Logout.php">Log out</a></p>
        </div>

    </div>

    <div class="outer_box">
        <div class="inerBox" style="width: 800px;">
            <table border=0 style="width:800px;">
                <tr>
                    <td class="td1" style="width:250px">
                        <ul>
                            <legend class="legend_style1">Acount</legend>
                            <hr>
                            <li><a style="color: #0000CD;text-align: left;text-decoration:underline;display: inline-block;" class="" href="Dashbord.php">Dashbord</a></li>
                            <li><a style="color: #0000CD;text-align: left;text-decoration: underline;display: inline-block;" class="" href="view_profile.php">View Profile</a></li>
                            <li><a style="color: #0000CD;text-align: left;text-decoration: underline;display: inline-block;" class="" href="edit_profile.php">Edit Profile</a></li>
                            <li><a style="color: #0000CD;text-align: left;text-decoration: underline;display: inline-block;" class="" href="picutre_uplode.php">Change Profile Picture</a></li>
                            <li><a style="color: #0000CD;text-align: left;text-decoration: underline;display: inline-block;" class="" href="change_password.php">Change Password</a></li>
                            <li><a style="color: #0000CD;text-align: left;text-decoration: underline;display: inline-block;" class="" href="Logout.php">Logout</a></li>
                        </ul>
                    </td>
                    <td style="width:550px; vertical-align:top;">
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
                                if (isset($message)) {
                                    echo $message;
                                }
                                ?>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>
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