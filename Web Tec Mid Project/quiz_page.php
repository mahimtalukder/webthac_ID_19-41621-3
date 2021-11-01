<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Quiz</title>
</head>


<body>
    <?php
    session_start();
    $course = "";
    $username="";
    $error = "";
    $quiz_no = 0;
    $question_1 = $question_2 = $question_3 = "";
    $question_1_Option_1 = $question_1_Option_2 = $question_1_Option_3 = "";
    $question_2_Option_1 = $question_2_Option_2 = $question_2_Option_3 = "";
    $question_3_Option_1 = $question_3_Option_2 = $question_3_Option_3 = "";
    $question_1_right_ans = $question_2_right_ans = $question_3_right_ans = "";
    $question_1_error = $question_2_error = $question_3_error = "";
    $question_1_set=$question_2_set=$question_3_set="";
    $count = 1;
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }

    if (isset($_SESSION['username']) && !isset($_SESSION['course'])) {
        header("location:dashboard.php");
    }

    $course = $_SESSION['course'];
    $username=$_SESSION['username'];
    if (isset($_SESSION['quiz_no'])) {
        $quiz_no = $_SESSION['quiz_no'];
    }

    require_once "Controller/getQuizController.php";
    $newObj = new getQuiz();

    $newData = array(
        'quiz_no' => $quiz_no,
        'course' => $course

    );

    $quiz = $newObj->quiz($newData);

    foreach ($quiz as $ques) {
        if ($count == 1) {
            $question_1 = $ques["question"];
            $question_1_Option_1 = $ques["option_1"];
            $question_1_Option_2 = $ques["option_2"];
            $question_1_Option_3 = $ques["option_3"];
            $question_1_right_ans = $ques["right_ans"];
        }
        if ($count == 2) {
            $question_2 = $ques["question"];
            $question_2_Option_1 = $ques["option_1"];
            $question_2_Option_2 = $ques["option_2"];
            $question_2_Option_3 = $ques["option_3"];
            $question_2_right_ans = $ques["right_ans"];
        }
        if ($count == 3) {
            $question_3 = $ques["question"];
            $question_3_Option_1 = $ques["option_1"];
            $question_3_Option_2 = $ques["option_2"];
            $question_3_Option_3 = $ques["option_3"];
            $question_3_right_ans = $ques["right_ans"];
        }
        $count = $count + 1;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["question_1_set"])){
            $question_1_error="Pleae select a option";
        }
        else{
            $question_1_set=$_POST["question_1_set"];
            if($question_1_set!=$question_1_right_ans){
                $question_1_error="Wrong ans!";
            }
        }

        if (empty($_POST["question_2_set"])){
            $question_2_error="Pleae select a option";
        }
        else{
            $question_2_set=$_POST["question_2_set"];
            if($question_2_set!=$question_2_right_ans){
                $question_2_error="Wrong ans!";
            }
        }

        if (empty($_POST["question_3_set"])){
            $question_3_error="Pleae select a option";
        }
        else{
            $question_3_set=$_POST["question_3_set"];
            if($question_3_set!=$question_3_right_ans){
                $question_3_error="Wrong ans!";
            }
        }

        if(empty($question_1_error) && empty($question_2_error) && empty($question_3_error)){
            require_once "Controller/getProgessController.php";
            $obj2 = new progress();

            $data=array(
                'username'=>$username,
                'course'=>$course
            );

            if(!empty($obj2->get_progess($data))){
                $progress=$obj2->get_progess($data);
                $send_data=array(
                    'username'=>$username,
                    'course'=>$course,
                    'lacture'=>$progress["lacture"]+1
                );

                require_once "Controller/addProgressController.php";
                $add=new progressAdder();
                $add->add_Updateprogress($send_data);
                header("location: courseDashboard.php");
            }
            else{
                $send_data=array(
                    'username'=>$username,
                    'course'=>$course,
                    'lacture'=>1
                );

                require_once "Controller/addProgressController.php";
                $add=new progressAdder();
                $add->add_Newprogress($send_data);
                header("location: courseDashboard.php");
            }
        }
    }


    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_barCourse.php' ?>
        <div class="portal-body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="gender">
                    <Legend class="legend_style"><?php echo $question_1; ?></Legend>
                    <input type="radio" name="question_1_set" <?php if (isset($question_1_set) && $question_1_set ==$question_1_Option_1) echo "checked"; ?> value="<?php echo $question_1_Option_1 ?>">
                    <label for="male"><?php echo $question_1_Option_1; ?></label>&nbsp
                    <input type="radio" name="question_1_set" <?php if (isset($question_1_set) && $question_1_set ==$question_1_Option_2) echo "checked"; ?> value="<?php echo $question_1_Option_2 ?>">
                    <label for="female"><?php echo $question_1_Option_2; ?></label>&nbsp
                    <input type="radio" name="question_1_set" <?php if (isset($question_1_set) && $question_1_set == $question_1_Option_3) echo "checked"; ?> value="<?php echo $question_1_Option_3 ?>">
                    <label for="other"><?php echo $question_1_Option_3; ?></label>
                    <hr>
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                        <?php
                        if ($question_1_error) {
                            echo ($question_1_error);
                        }
                        ?>
                    </span>


                    <Legend class="legend_style"><?php echo $question_2; ?></Legend>
                    <input type="radio" name="question_2_set" <?php if (isset($question_2_set) && $question_2_set ==$question_2_Option_1) echo "checked"; ?> value="<?php echo $question_2_Option_1 ?>">
                    <label for="male"><?php echo $question_2_Option_1; ?></label>&nbsp
                    <input type="radio" name="question_2_set" <?php if (isset($question_2_set) && $question_2_set ==$question_2_Option_2) echo "checked"; ?> value="<?php echo $question_2_Option_2 ?>">
                    <label for="female"><?php echo $question_2_Option_2; ?></label>&nbsp
                    <input type="radio" name="question_2_set" <?php if (isset($question_2_set) && $question_2_set == $question_2_Option_3) echo "checked"; ?> value="<?php echo $question_2_Option_3 ?>">
                    <label for="other"><?php echo $question_2_Option_3; ?></label>
                    <hr>
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                        <?php
                        if ($question_2_error) {
                            echo ($question_2_error);
                        }
                        ?>
                    </span>


                    <Legend class="legend_style"><?php echo $question_3; ?></Legend>
                    <input type="radio" name="question_3_set" <?php if (isset($question_3_set) && $question_3_set ==$question_3_Option_1) echo "checked"; ?> value="<?php echo $question_3_Option_1 ?>">
                    <label for="male"><?php echo $question_3_Option_1; ?></label>&nbsp
                    <input type="radio" name="question_3_set" <?php if (isset($question_3_set) && $question_3_set ==$question_3_Option_2) echo "checked"; ?> value="<?php echo $question_3_Option_2 ?>">
                    <label for="female"><?php echo $question_3_Option_2; ?></label>&nbsp
                    <input type="radio" name="question_3_set" <?php if (isset($question_3_set) && $question_3_set == $question_3_Option_3) echo "checked"; ?> value="<?php echo $question_3_Option_3 ?>">
                    <label for="other"><?php echo $question_3_Option_3; ?></label>
                    <hr>
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                        <?php
                        if ($question_3_error) {
                            echo ($question_3_error);
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
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>