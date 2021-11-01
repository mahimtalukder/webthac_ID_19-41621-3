<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Change Password</title>
</head>


<body>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $password = $_POST["password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        $learner=array(
            'username'=>$username,
            'password'=>$password,
            'new_password'=>$new_password,
            'confirm_password'=>$confirm_password
        );

        require_once "Controller/change_passwordController.php";
        $obj=new passwordCon();

        $obj->password_change($learner);

        $error=$obj->get_error();
        $passwordErr=$error["passwordErr"];
        $new_passwordErr=$error["new_passwordErr"];
        $confirm_passwordErr=$error["confirm_passwordErr"];

        $message=$obj->get_messege();
    }
    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">

            <!-- Write your code here -->

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Change Password</h1>
                <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </span>
                <br>

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
            </form>

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
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

        function myFunction1() {
            var x = document.getElementById("password1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>