<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>
        Registration
    </title>
</head>

<body class="background_color">
    <?php
    $nameErr = $emailErr = $genderErr = $dobErr = $usernameErr = $passwordErr = $confirm_passwordErr = $message = $error = "";
    $name = $email = $gender = $dob = $username = $password = $confirm_password  = "";
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $username =  test_input($_POST["username"]);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];



        if (empty($name)) {
            $nameErr = "Name is required";
        } else {
            if ((str_word_count($name)) < 2) {
                $nameErr = "The name must have at least two word";
            } else {
                if ((preg_match("/[A-Za-z]/", $name[0])) == 0) {
                    $nameErr = "The name must have start with litter";
                } else {
                    if (preg_match('/^[A-Za-z\s._-]+$/', $name) !== 1) {
                        $nameErr = "Name can contain letter,desh,dot and space";
                    }
                }
            }
        }

        if (empty($email)) {
            $emailErr = "Email is required";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

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
                }
            }
        }

        if (empty($confirm_password)) {
            $confirm_passwordErr = "Confirm Password is required";
        } else {
            if (strcmp($password, $confirm_password) !== 0) {
                $confirm_passwordErr = "Password are not matched";
            }
        }





        if (empty($_POST["dob"])) {
            $dobErr = "Date of Birth required";
        } else {
            if ($_POST["dob"] > date('Y-m-d')) {
                $dobErr = "Invalide input";
            } else {
                $dob = $_POST["dob"];
            }
        }


        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }


        if (file_exists('data.json') && empty($nameErr) && empty($emailErr) && empty($usernameErr) && empty($passwordErr) && empty($confirm_passwordErr) && empty($dobErr) && empty($genderErr)) {
            $current_data = file_get_contents('data.json');
            $array_data = json_decode($current_data, true);
            $extra = array(
                'name'               =>     $name,
                'email'          =>     $email,
                'username'     =>    $username,
                'password'     =>    $password,
                'dob'     =>     $dob,
                'gender'     =>     $gender,
                'picture' => "broken.png"
            );
            $array_data[] = $extra;
            $final_data = json_encode($array_data);
            if (file_put_contents('data.json', $final_data)) {
                $message = "<label class='text-success'>Account Created</p>";
            }
        } else {
            $error = 'JSON File does not exist';
        }
    }
    ?>


    <div class="header">
        <p class="logo"><?php include 'header.php'; ?></p>
        <div class="header-right">
            <a href="login.php">Login</a>
            <a href="Home.php">Home</a>
            <a class="active" href="Registration.php">Registration</a>
        </div>

    </div>

    <div class="outer_box">
        <div class="inerBox">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Enter Your Information</h1>
                <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </span>

                <div class="name_email">
                    <div class="name">
                        <legend class="legend_style1">Name:</legend>
                        <input type="text" id="name" name="name" class="input_style" placeholder="Mr. example" value="<?php echo $name; ?>">
                        <br>
                        <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <?php
                            if ($nameErr) {
                                echo ($nameErr);
                            }
                            ?>
                        </span>
                    </div>

                    <div class="email">
                        <legend class="legend_style1">Email:</legend>
                        <input type="text" id="email" name="email" class="input_style" placeholder="someone@example.com" value="<?php echo $email; ?>">
                        <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                            <br>
                            <?php
                            if ($emailErr) {
                                echo ($emailErr);
                            }
                            ?>
                        </span>
                    </div>
                </div>

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
                <input type="checkbox" onclick="myFunction()"><label class="label1">Show Password</label>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($passwordErr) {
                        echo ($passwordErr);
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

                <legend class="legend_style">Date of Birth:</legend>
                <div class="dob">
                    <input type="date" class="input_style" name="dob" max="<?= date('Y-m-d'); ?>" value="<?php echo $dob; ?>">
                </div>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($dobErr) {
                        echo ($dobErr);
                    }
                    ?>
                </span>

                <div class="gender">
                    <Legend class="legend_style">Gender:</Legend>
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">
                    <label for="male">Male</label>&nbsp
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">
                    <label for="female">Female</label>&nbsp
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">
                    <label for="other">Other</label>
                    <hr>
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                        <?php
                        if ($genderErr) {
                            echo ($genderErr);
                        }
                        ?>
                    </span>
                </div>

                <div class="button">
                    <input type="submit" class="submit_button" value="Submit">
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
    </script>
</body>

</html>