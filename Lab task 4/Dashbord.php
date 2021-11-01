<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>
        Dashbord
    </title>
</head>

<body class="background_color">
    <?php

    session_start();
    if (!isset($_SESSION['username'])) {
		session_destroy();
		header("location:login.php");
	}
    $usernameErr = $passwordErr = $confirm_passwordErr = "";
    $name = $username = $password  = "";

    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    }

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
                } else {
                    $data = file_get_contents("data.json");
                    $data = json_decode($data, true);
                    foreach ($data as $row) {
                        if ($row["username"] == $username) {
                            $usernameErr = "Username already exists";
                            break;
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
    }
    ?>


    <div class="header">
        <p class="logo"><?php include 'header.php'; ?></p>
        <div class="header-right">
            <p style="display: flex;color: white;font-size: 18px;"> Log in as: <a class="active" href="#home"><?php echo $name; ?></a><a href="Logout.php">Log out</a></p>
        </div>

    </div>

    <div class="outer_box">
        <div class="inerBox">

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
                    <td class="td2" style="width:550px; vertical-align:top;">
                        <br>
                        <legend class="legend_style1">Welcome <?php echo $name; ?></legend>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>