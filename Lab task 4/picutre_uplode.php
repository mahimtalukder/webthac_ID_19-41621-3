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
    $pictureErr = $passwordErr = $confirm_passwordErr = "";
    $ImageError = $UploadConfirmation = "";
    $target_file = "";
    $old_file = $_SESSION['picture'];
    $mypic = "";

    if (isset($_POST['submit'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";
        if ($_FILES['fileToUpload']['name'] != "") {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {

                $uploaded = 1;
            } else {
                $ImageError = "File is not an image.";
                $uploaded = 0;
            }

            if (file_exists($target_file)) {
                $ImageError = "File already exists.";
                $uploaded = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 40000000000) {
                $ImageError = "Sorry, your file is too large.";
                $uploaded = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $ImageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploaded = 0;
            }

            if ($uploaded == 0) {
                $ImageError = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $mypic = $target_file;
                    $UploadConfirmation = "File has been uploaded Successfully";
                    if ($old_file != "broken.png") {
                        unlink($old_file);
                    }
                    $filepath = $target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));

                    $data = file_get_contents("data.json");
                    $data = json_decode($data, true);
                    if (!empty($data)) {
                        foreach ($data as $key => $row) {
                            if ($row["username"] == $_SESSION['username']) {
                                $data[$key]['picture'] = $filepath;
                                $_SESSION['picture'] = $filepath;
                                break;
                            }
                        }

                        file_put_contents('data.json', json_encode($data));
                    }
                } else {
                    $ImageError = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $ImageError = "No Image was selected";
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
                        <br>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                            <h1>Change Picture</h1>

                            <img src="<?php if (!empty($filepath)) {
                                            echo $filepath;
                                        } else {
                                            echo $old_file;
                                        } ?>" alt="" width="300px" height="300px"><br>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                                <?php
                                if ($ImageError !== "") {
                                    echo ($ImageError);
                                }
                                ?>
                            </span>
                            <div class="button">
                                <input type="submit" name="submit" class="submit_button" value="Submit">
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