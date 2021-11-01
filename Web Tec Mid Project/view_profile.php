<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>View Profile</title>
</head>


<body>
<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }

    if (isset( $_SESSION['quiz_no'])) {
        unset($_SESSION['quiz_no']);
    }
    if (isset($_SESSION['course'])) {
        unset($_SESSION['course']);
	}
$name = $username = $email= $dob= $picture= "";

if (isset($_SESSION['username'])) {
    $username=$_SESSION['username'];
    require_once "Controller/receiceLearnerInfoController.php";
    $obj=new student_info();
    $learner=$obj->get_learner($username);

    $name=$learner['name'];
    $email=$learner['email'];
    $dob=$learner['dob'];
    $gender=$learner['gender'];
    $picture=$learner['picture'];
}

?>


    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">

            <!-- Write your code here -->

            <table border=0 style="width: 800px;">
                      <tr>
                          <td style="width:500px; ">
                            <label >Name: <?php echo $name ?></label>
                            <hr>
                            <br>
                            <label >Email: <?php echo $email ?></label>
                            <hr>
                            <br>
                            <label >Gender: <?php echo $gender ?></label>
                            <hr>
                            <br>
                            <label >Date of birth: <?php echo $dob ?></label>
                            <hr>
                          </td>
                          <td style="width:300px">
                            <img src="<?php echo $picture ?>" width="300px" height="250px">
                          </td>
                      </tr>
                    </table>

            <!-- End your code here -->
            
        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>