<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Client Footer</title>
</head>

<body>
    <div class="portal-footer">
        <hr>
        <div class="block-description-one">
            <a title="ProductManagement" href="#" , style="font-size: x-large;">Product Management</a>
            <p class="footer-copyright">&copy; 2021
                <?php if (date("Y") != "2021") {
                    echo " - ", date("Y");
                } ?> Product Management. All Rights Reserved</p>
        </div>
        <div class="block-description-two">
            <p>Developed by Md. Mahim Talukder</p>
        </div>

    </div>
</body>