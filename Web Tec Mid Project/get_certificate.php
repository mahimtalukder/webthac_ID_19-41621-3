<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Community</title>
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


    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_barCourse.php' ?>
        <div class="portal-body">


            <!-- Write your code here -->
            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                <?php
                  echo "Not available yet!";
                ?>
            </span>
            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>