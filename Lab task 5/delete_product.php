
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Delete Product</title>
</head>


<body>
    <?php
    session_start();
    $buying_price = $selling_price = $display = "";
    if(!empty($_GET["name"])){
        $_SESSION["name"]=$_GET["name"];
    }

    require_once "Controller/displayProductController.php";
    $obj = new getInfo();
    if (!empty($obj->get_a_product($_SESSION["name"]))) {
        $product = $obj->get_a_product($_SESSION["name"]);
        $buying_price=$product["buying_price"];
        $selling_price=$product["selling_price"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "Controller/deleteProductController.php";
        $del = new delete();
        $del->delete_info($_SESSION["name"]);

        setcookie("delete_message", "Information Deleted!", time() + 3);
        session_destroy();
        header("location: display_product.php");
    }


    ?>
    <div class="split-screen">
        <?php include 'client_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="user_name">
                    <legend class="legend_style1">Name: <?php echo $_SESSION["name"]; ?></legend>
                    <hr>
                </div>

                <div class="user_name">
                    <legend class="legend_style1">Buying Price: <?php echo $buying_price; ?></legend>
                    <hr>
                </div>

                <div class="user_name">
                    <legend class="legend_style1">Selling Price: <?php echo $selling_price; ?></legend>
                    <hr>
                </div>

                <input type="checkbox" name="display" <?php if (isset($display) && $display == "yes") echo "checked"; ?> checked value="yes">
                <label class="label1">Diplay</label>

                <div class="button">
                    <input type="submit" class="submit_button" value="Delete">
                </div>
            </form>
            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>