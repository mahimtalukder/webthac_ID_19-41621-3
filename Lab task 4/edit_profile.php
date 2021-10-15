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
    $nameErr =$emailErr=$dobErr=$genderErr = $passwordErr = $confirm_passwordErr = "";
    $name = $username = $password  = $email = $dob = $picture = "";
    $username=$_SESSION["username"];

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

        if(empty($nameErr) && empty($emailErr) && empty($genderErr)){
            $data = file_get_contents("data.json");
            $data = json_decode($data, true);
            foreach ($data as $row) {
                if ($row["username"] == $username) {
                    $data = file_get_contents("data.json");
                    $data = json_decode($data, true);
                    if (!empty($data)) {
                        foreach ($data as $key => $row) {
                            if ($row["username"] == $_SESSION['username']) {
                                $data[$key]['name'] = $name;
                                $_SESSION['name'] = $name;
                                $data[$key]['email'] = $email;
                                $_SESSION['email'] = $email;
                                $data[$key]['dob'] = $dob;
                                $_SESSION['dob'] = $dob;
                                $data[$key]['gender'] = $gender;
                                $_SESSION['gender'] = $gender;
                                $message = "Information changed!";
                                break;
                            }
                        }

                        file_put_contents('data.json', json_encode($data));
                    }
                    break;
                }
            }
        } 
    }
    ?>


    <div class="header">
        <p class="logo"><?php include 'header.php'; ?></p>
        <div class="header-right">
            <p style="display: flex;color: white;font-size: 18px;"> Log in as: <a class="active" href="#home"><?php echo $_SESSION['name']; ?></a><a href="Logout.php">Log out</a></p>
        </div>

    </div>

    <div class="outer_box">
        <div class="inerBox">

            <table border=0 style="width:800px;">
                <tr>
                    <td class="td1" style="width:250px; border-right: solid 1px #000000;">
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
                        <legend class="legend_style1"><b>Edit Profile</b></legend>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                                <?php
                                if (isset($message)) {
                                    echo $message;
                                }
                                ?>
                            </span>
                            <legend class="legend_style1">Name:</legend>
                            <input type="text" id="name" name="name" class="input_style" placeholder="Mr. example" value="<?php  if(empty($name)){echo $_SESSION['name'];}else{echo $name;} ?>">
                            <br>
                            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                                <?php
                                if ($nameErr) {
                                    echo ($nameErr);
                                }
                                ?>
                            </span>

                            <legend class="legend_style1">Email:</legend>
                            <input type="text" id="email" name="email" class="input_style" placeholder="someone@example.com" value="<?php if(empty($email)){echo  $_SESSION['email'];} else{echo $email;} ?>">
                            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                                <br>
                                <?php
                                if ($emailErr) {
                                    echo ($emailErr);
                                }
                                ?>
                            </span>

                            <legend class="legend_style">Date of Birth:</legend>
                            <div class="dob">
                                <input type="date" class="input_style" name="dob" max="<?= date('Y-m-d'); ?>" value="<?php if(empty($dob)){echo $_SESSION['dob'];} else{echo $dob;} ?>">
                            </div>
                            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                                <?php
                                if ($dobErr) {
                                    echo ($dobErr);
                                }
                                ?>
                            </span>

                            <Legend class="legend_style">Gender:</Legend>
                            <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male"){ echo "checked";} elseif($_SESSION['gender']=="male"){echo "checked";} ?> value="male">
                            <label for="male">Male</label>&nbsp
                            <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female"){ echo "checked";} elseif($_SESSION['gender']=="female"){echo "checked";} ?> value="female">
                            <label for="female">Female</label>&nbsp
                            <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other"){ echo "checked";} elseif($_SESSION['gender']=="other"){echo "checked";} ?> value="other">
                            <label for="other">Other</label>
                            <hr>
                            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                                <?php
                                if ($genderErr) {
                                    echo ($genderErr);
                                }
                                ?>
                            </span>

                            <div class="button">
                                <input type="submit" class="submit_button" value="Submit">
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
</body>

</html>