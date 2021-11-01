<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Certificate</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>


<body>
    <?php
    session_start();
    $course = $username = "";
    $error = $message = "";
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }

    if (isset($_SESSION['username']) && !isset($_SESSION['course'])) {
        header("location:dashboard.php");
    }

    if (isset($_SESSION['quiz_no'])) {
        unset($_SESSION['quiz_no']);
    }

    $username = $_SESSION['username'];
    $course = $_SESSION['course'];

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

            <h1>Community</h1>

            <table border=0 id="customers">
                <tr>
                    <th style="vertical-align: top;">Details Of problem</th>
                    <td>
                        <table id="customers">
                            <tr>
                                <th>Problem Name</th>
                                <th>Uplode Date</th>
                            </tr>
                            <tr>
                                <td>Abc </td>
                                <td>October 10, 2020</td>
                            </tr>
                            <tr>
                                <td>BCD </td>
                                <td>October 07, 2020</td>
                            </tr>
                            <tr>
                                <td>EFG </td>
                                <td>October 1, 2020</td>
                            </tr>
                            <tr>
                                <td>EFG </td>
                                <td>October 1, 2020</td>
                            </tr>
                            <tr>
                                <td>EFG </td>
                                <td>October 1, 2020</td>
                            </tr>
                            <tr>
                                <td>EFG </td>
                                <td>October 1, 2020</td>
                            </tr>
                            <tr>
                                <td>EFG </td>
                                <td>October 1, 2020</td>
                            </tr>
                            <tr>
                                <td>EFG </td>
                                <td>October 1, 2020</td>
                            </tr>
                        </table>
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