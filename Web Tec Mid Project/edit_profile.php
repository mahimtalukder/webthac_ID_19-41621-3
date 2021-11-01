<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Edit Profile</title>
</head>


<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }

    $nameErr = $emailErr = $genderErr = $dobErr  = $message = $error = "";
    $name = $email = $gender = $dob =  "";
    $data=[];
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if(isset($_SESSION['username'])){
        $username=$_SESSION['username'];
        require_once "Controller/receiceLearnerInfoController.php";
        $obj=new student_info();
        $learner=$obj->get_learner($username);

        $name=$learner["name"];
        $email=$learner["email"];
        $gender=$learner["gender"];
        $dob=$learner["dob"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        if(!empty($_POST["gender"])){
            $gender=$_POST["gender"];
        }
        else{
            $gender="";
        }
        if(!empty($_POST["dob"])){
            $dob=$_POST["dob"];
        }

        $data= array(
            'name'=> $name,
            'username'=>$username,
            'email'=>$email,
            'dob'=> $dob,
            'gender'=>$gender
        );


        require_once "Controller/updateLearnerController.php";
        $learner= new update();

        $learner->update_learner($data);

        $error=$learner->get_error();
        $message=$learner->get_messege();

        $nameErr=$error["nameErr"];
        $emailErr=$error["emailErr"];
        $dobErr=$error["dobErr"];
        $genderErr=$error["genderErr"];
    }
    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">

            <!-- Write your code here -->
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
                        <legend class="legend_style1"><br>Email:</legend>
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

            <!-- End your code here -->
            
        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>