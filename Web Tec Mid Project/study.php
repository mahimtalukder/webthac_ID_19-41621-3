<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Study</title>
</head>


<body>
    <?php
    session_start();
    $course = $username = $message="";
    $error = "";
    $lacture = array();
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }

    if (isset($_SESSION['username']) && !isset($_SESSION['course'])) {
        header("location:dashboard.php");
    }

    if (isset( $_SESSION['quiz_no'])) {
        unset($_SESSION['quiz_no']);
    }

    $course = $_SESSION['course'];
    $username = $_SESSION['username'];

    $data = array(
        'username' => $username,
        'course' => $course
    );

    require_once "Controller/getProgessController.php";
    $obj = new progress();

    $pogress = $obj->get_progess($data);

    if (!empty($obj->get_progess($data))) {
        $old_lacture = $pogress["lacture"];
        $new_lactureName = $old_lacture + 1;
        $lacture_data = array(
            'name' => $new_lactureName,
            'course' => $course
        );

        require_once "Controller/getLactureController.php";
        $obj2 = new lacture();
        $lacture = $obj2->get_lacture($lacture_data);
    } else {
        require_once "Controller/getLactureController.php";
        $lacture_data = array(
            'name' => 1,
            'course' => $course
        );
        $obj2 = new lacture();
        $lacture = $obj2->get_lacture($lacture_data);
    }

    if (empty($lacture)) {
        $error = "No lacture available yet!";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($obj->get_progess($data))) {
            $old_lacture = $pogress["lacture"];

            require_once "Controller/getQuizController.php";
            $newObj= new getQuiz();

            $newData=array(
                'quiz_no'=> $old_lacture+1,
                'course' => $course

            );

            $quiz=$newObj->quiz($newData);

            if(!empty($quiz)){
                $_SESSION['quiz_no'] = $old_lacture;
                header("location: quiz_page.php");
            }
            else{
                $message="No quiz available yet";
            }

        }
        else{
            require_once "Controller/getQuizController.php";
            $newObj= new getQuiz();

            $newData=array(
                'quiz_no'=> 1,
                'course' => $course

            );

            $quiz=$newObj->quiz($newData);

            if(!empty($quiz)){
                $_SESSION['quiz_no'] = 1;
                header("location: quiz_page.php");
            }
        }
    }

    



    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_barCourse.php' ?>
        <div class="portal-body">
            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                <?php
                if ($error) {
                    echo ($error);
                }
                ?>
            </span>
            <br>

            <video width="320" height="240" controls>
                <source src="<?php echo $lacture["lacture"]; ?>" type="video/mp4">

                Your browser does not support the video tag.
            </video>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div>
                    <input type='submit' name='submit' class='submit_button' value='next'>
                </div>

                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                <?php
                if ($message) {
                    echo ($message);
                }
                ?>
            </span>
            <br>
            </form>

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>