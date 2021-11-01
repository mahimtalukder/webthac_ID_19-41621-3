<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Home</title>
</head>

<?php
    require_once "Controller/get_courseController.php";
    $obj=new course();
    $couse = $obj->get_couse();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $couse_name= $_POST["submit"];

        $data=array(
            'username'=>$_SESSION['username'],
            'course'=>$couse_name
        );

        header("location: login.php");
        
    }

?>

<body>
    <div class="split-screen">
        <?php include 'client_header.php'; ?>
        <div class="right">
            <h1>Welcome to ProgSchool!</h1>
            <h1>Available courses:</h1>
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
        </div>
    </div>
    <?php include 'client_footer.php' ?>
</body>

</html>