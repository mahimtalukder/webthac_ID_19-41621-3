<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Dashboard</title>
</head>


<body>
    <?php
    session_start();
    $course = array();
    $error = "";
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }

    require_once "Controller/get_courseController.php";
    $obj = new course();
    $learner = $obj->get_leaarnerCourse($_SESSION['username']);


    if (empty($learner)) {
        $error = "First, add a course to start your study!";
    } else {
        $course = $learner["course"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $couse_name= $_POST["submit"];

        $_SESSION['course'] = $couse_name;
        header("location:courseDashboard.php");
    }


    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">

            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                <?php
                if ($error) {
                    echo ($error);
                }
                ?>
            </span>

            <!-- Write your code here -->

            <table border=1 style="width: 800px;">
                <tr>
                    <td><b> Course Name </b></td>
                    <td><b> Progress </b></td>
                </tr>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <?php
                    foreach ($course as $row) {
                        echo "<tr>";
                        $name = $row;
                        echo "<td> <div >  <input type='submit' name='submit' class='submit_button2' value='$name' > </div> </td>";
                        echo "<td></td>";
                        echo "</tr>";
                    }
                    ?>
                </form>
            </table>

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>