<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>
        Picture
    </title>
</head>

<body class="background_color">
    <?php
    $pictureErr=$passwordErr=$confirm_passwordErr= "";
    $ImageError = $UploadConfirmation = "";
    $target_file="";
    $mypic="";

    if(isset($_POST['submit'])){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";    
        if($_FILES['fileToUpload']['name'] != "")
        {
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
                    $mypic=$target_file;
                    $UploadConfirmation = "File has been uploaded Successfully";
                    $filepath = $target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                } else {
                    $ImageError = "Sorry, there was an error uploading your file.";
                }
            }
        }else{
            $ImageError="No Image was selected";
        }
    }
    ?>


    <div class="header">
        <p class="logo"><?php include 'header.php'; ?></p>
        <div class="header-right">
        <a href="login.php">Login</a>
        <a class="active" href="#home">Home</a>
        <a href="Registration.php">Registration</a>
        </div>

    </div>

    <div class="outer_box">
        <div class="inerBox">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <h1>Change Picture</h1>

              <div class="picture">
                  <img src="<?php if(!empty($mypic)){echo $mypic;}else{ echo "broken.png";} ?>" alt="" width="300px" height="300px"><br>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($ImageError!=="") {
                        echo ($ImageError);
                    }
                    ?>
                  </span>
              </div>
              <div class="button">
                    <input type="submit" name="submit" class="submit_button" value="Submit">
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>