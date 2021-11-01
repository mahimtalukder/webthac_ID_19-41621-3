<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Dashboard</title>
</head>


<body>
    <?php
    session_start();
    $message = $error = "";
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }
    require_once "Controller/get_courseController.php";
    $obj=new course();
    $couse = $obj->get_couse();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $couse_name= $_POST["submit"];

        $data=array(
            'username'=>$_SESSION['username'],
            'course'=>$couse_name
        );

        require_once "Controller/addLearnerCourseController.php";
        $obj=new addLearnerCourse();

        $message=$obj->add_course($data);

        $error=$obj->get_error();
        
    }

    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">
        <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </span>

                <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                    <?php
                    if ($error) {
                        echo ($error);
                    }
                    ?>
                </span>
                <br>

            <!-- Write your code here -->

            <table border=1 style="width: 800px;">
                <tr>
                <td><b> Course Name </b></td>
                <td><b> Cost </b></td>
                </tr>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <?php
                foreach ($couse as $row) {
                    echo "<tr>";
                    $name = $row["name"];
                    $cost = $row["cost"];
                    echo "<td> <div >  <input type='submit' name='submit' class='submit_button2' value='$name' > </div> </td>";
                    echo "<td> $cost </td>";
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