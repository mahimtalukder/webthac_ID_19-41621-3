
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Edit Product</title>
</head>


<body>
    <?php
    session_start();
    $name = $new_name= $prv_name = $buying_price = $selling_price = $nameErr = $buying_priceErr = $display = $selling_priceErr = $message = "";
    if(!empty($_GET["name"])){
        $_SESSION["name"]=$_GET["name"];
    }
    if(!isset($_SESSION["name"])){
        header("location: display_product.php");
    }
    $error = array();
    $prv_name = $_SESSION["name"];

    require_once "Controller/displayProductController.php";
    $obj = new getInfo();
    if (!empty($obj->get_a_product($prv_name))) {
        $product = $obj->get_a_product($prv_name);
        $name=  $prv_name;
        $buying_price=$product["buying_price"];
        $selling_price=$product["selling_price"];
        $display = $product["display"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_name = $_POST["name"];
        $buying_price = $_POST["buying_price"];
        $selling_price = $_POST["selling_price"];

        if (empty($_POST["display"])) {
            $display = "no";
        } else {
            $display = "yes";
        }

        $data = array(
            "new_name" => $_POST["name"],
            "name" => $name,
            "prv_name"=>$prv_name,
            "buying_price" => $_POST["buying_price"],
            "selling_price" => $_POST["selling_price"],
            "display" => $display,
        );

        require_once "Controller/editProductController.php";
        $obj = new edit();
        $message = $obj->edit_info($data);

        $error = $obj->get_error();

        $nameErr = $error["nameErr"];
        $buying_priceErr = $error["buying_priceErr"];
        $selling_priceErr = $error["selling_priceErr"];
    }


    ?>
    <div class="split-screen">
        <?php include 'client_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </span>


                <div class="user_name">
                    <legend class="legend_style1">Name:</legend>
                    <input type="text" name="name" class="input_style" placeholder="abc" value="<?php if(empty($new_name)){echo $name;}else{echo $new_name;} ?>">
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                        <br>
                        <?php
                        if ($nameErr) {
                            echo ($nameErr);
                        }
                        ?>
                    </span>
                </div>

                <div class="user_name">
                    <legend class="legend_style1">Buying Price:</legend>
                    <input type="text" name="buying_price" class="input_style" placeholder="abc" value="<?php echo $buying_price; ?>">
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                        <br>
                        <?php
                        if ($buying_priceErr) {
                            echo ($buying_priceErr);
                        }
                        ?>
                    </span>
                </div>

                <div class="user_name">
                    <legend class="legend_style1">Selling Price:</legend>
                    <input type="text" name="selling_price" class="input_style" placeholder="abc" value="<?php echo $selling_price; ?>">
                    <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                        <br>
                        <?php
                        if ($selling_priceErr) {
                            echo ($selling_priceErr);
                        }
                        ?>
                    </span>
                </div>

                <input type="checkbox" name="display" <?php if (isset($display) && $display == "yes") echo "checked"; ?> value="yes">
                <label class="label1">Diplay</label>

                <div class="button">
                    <input type="submit" class="submit_button" value="Save">
                </div>
            </form>
            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>