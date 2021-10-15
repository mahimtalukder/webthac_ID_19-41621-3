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
    $email  = "";
    $emailErr = "";
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $emailFound = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email =  test_input($_POST["email"]);

        if (empty($email)) {
            $emailErr = "Email is required";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            } else {
                $data = file_get_contents("data.json");
                $data = json_decode($data, true);
                if (!empty($data)) {
                    foreach ($data as $row) {
                        if ($row["email"] == $email) {
                            $emailFound = true;
                            break;
                        }
                    }
                }
                if ($emailFound == false) {
                    $emailErr = "email not found";
                } else {
                    $message = "A mail has been sent. Please check your email inbox";
                }
            }
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
        <div class="inerBox" style="width:500px; display:flex;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Reset Passsword</h1>
                <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </span>

                <legend class="legend_style">Email:</legend>
                <div class="user_name">
                    <input type="text" name="email" id="email" class="input_style" placeholder="example@abcd.com" value="<?php echo $email; ?>">
                </div>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($emailErr) {
                        echo ($emailErr);
                    }
                    ?>
                </span>

                <div class="button">
                    <input type="submit" class="submit_button" value="Submit">
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>