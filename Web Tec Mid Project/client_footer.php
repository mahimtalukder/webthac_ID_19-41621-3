<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Client Footer</title>
</head>

<body>
    <div class="footer">
        <hr>
        <div class="block-description-one">
            <a title="ProgSchool" href="#" , style="font-size: x-large;">ProgSchool</a>
            <p>ProgSchool is a fun, interactive, visual, and friendly way to learn programming.</p>
            <small class="footer-copyright">&copy; 2021
                <?php if (date("Y") != "2021") {
                    echo " - ", date("Y");
                } ?> ProgSchool. All Rights Reserved</small>
        </div>
        <div class="block-description-two">
            <a href="">Terms and Condition</a>
            <a href="">Blog</a>
            <a href="">Refund Policy</a>
        </div>

    </div>
</body>