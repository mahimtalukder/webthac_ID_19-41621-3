<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Dashboard</title>
</head>
<?php
$nameErr = $emailErr = $genderErr = $dobErr = $usernameErr = $passwordErr = $confirm_passwordErr = $message = $error = "";
$name = $email = $gender = $dob = $username = $password = $confirm_password  = "";
$data = [];
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
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $dob = $_POST["dob"];
    if (!empty($_POST["gender"])) {
        $gender = $_POST["gender"];
    } else {
        $gender = "";
    }
    if (!empty($_POST["dob"])) {
        $dob = $_POST["dob"];
    }

    $data = array(
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'confirm_password' => $confirm_password,
        'dob' => $dob,
        'gender' => $gender
    );


    require_once "Controller/addLearnerController.php";
    $learner = new addstudent();

    $learner->addData($data);

    $error = $learner->get_error();
    $message = $learner->get_messege();

    $nameErr = $error["nameErr"];
    $emailErr = $error["emailErr"];
    $passwordErr = $error["passwordErr"];
    $confirm_passwordErr = $error["confirm_passwordErr"];
    $dobErr = $error["dobErr"];
    $genderErr = $error["genderErr"];
}
?>


<body>
    <div class="split-screen">
        <?php include 'client_header.php'; ?>
        <div style="margin: 0;display: flex;justify-content: center;align-items: center; padding: 10px; font-size: 25px; font-weight: 500;">
            <div style=" width: 350px; background: #fff;display: flex;padding-left: 50px;box-shadow: -2px 2px 20px #696969;border-radius: 15px;">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                        <?php
                        if (isset($message)) {
                            echo $message;
                        }
                        ?>
                    </span>
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

                    <legend class="legend_style">Password:</legend>
                    <div class="user_name">
                        <input type="password" name="password" id="password" class="input_style_password" value="<?php echo $password; ?>">
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