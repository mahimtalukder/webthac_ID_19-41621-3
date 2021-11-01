<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Course Dashboard</title>
</head>


<body>
    <?php
    session_start();
    $course = $username= "";
    $error =$message= "";
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

    $username=$_SESSION['username'];
    $course=$_SESSION['course'];

    $data = array(
        'username' => $username,
        'course' => $course
    );

    require_once "Controller/getProgessController.php";
    $obj = new progress();

    $pogress = $obj->get_progess($data);

    if(!empty($obj->get_progess($data))){
        $message="Lacture ".$pogress["lacture"]." completed!";
    }
    else{
        $message="Not available yet!";
    }

    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_barCourse.php' ?>
        <div class="portal-body">


            <!-- Write your code here -->

            <table border=1 style="width: 800px;">
                <tr>
                    <td><b> Course Name </b></td>
                    <td><b> Progress </b></td>
                </tr>
                <tr>
                    <td> <?php echo $course ?></td>
                    <td> <?php echo $message ?></td>
                </tr>
            </table>

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>