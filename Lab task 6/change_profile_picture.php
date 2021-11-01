<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Change Profile Picture</title>
</head>


<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }
    require_once "Controller/receiceLearnerInfoController.php";
    $obj=new student_info();
    $learner=$obj->get_learner($_SESSION['username']);
    
    $pictureErr =  "";
    $ImageError = $UploadConfirmation = "";
    $target_file = "";
    $old_file = $learner['picture'];
    $mypic = "";

    if (isset($_POST['submit'])) {
        $target_file = $_FILES["fileToUpload"]["name"];
        

        $learner=array(
            'file'=>  $target_file,
            'old_file'=> $learner['picture'],
            'username'=>$learner['username'],
            'temp_name'=>$_FILES["fileToUpload"]["tmp_name"],
            'size'=>$_FILES["fileToUpload"]["size"]
        );

        require_once "Controller/pictureChangeController.php";
        $obj=new picture();

        $filepath=$obj->change_picture($learner);

        $error=$obj->get_error();
        $ImageError=$error["pictureErr"];
        $message=$obj->get_messege();
       
    }
    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">

            <!-- Write your code here -->

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <h1>Change Picture</h1>
                <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </span>
                <br>

                <img src="<?php echo $learner["picture"]; ?>" alt="" width="300px" height="300px"><br>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <br>
                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($ImageError !== "") {
                        echo ($ImageError);
                    }
                    ?>
                </span>
                <div class="button">
                    <input type="submit" name="submit" class="submit_button" value="Upload">
                </div>
            </form>

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>