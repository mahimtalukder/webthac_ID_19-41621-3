<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Portal Header</title>
</head>

<body>
    <div class="portal-header">
        <div class="block-description-one">
            <a title="ProgSchool" href="dashboard.php" , style="font-size: x-large;">ProgSchool Portal</a>
        </div>
        <div class="block-description-two">
            <?php
        
            require_once "Controller/receiceLearnerInfoController.php";
            $obj=new student_info();
            $learner=$obj->get_learner($_SESSION['username']);
            ?>
            <ul>
                <li><a href="view_profile.php">Welcome <?php echo $learner["name"] ?></a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</body>