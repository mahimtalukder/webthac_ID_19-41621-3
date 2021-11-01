<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Display</title>
</head>


<body>
    <?php
    session_start();
    if (isset($_SESSION["name"])) {
        session_destroy();
    }
    $name = $buying_price = $selling_price = $nameErr = $buying_priceErr = $display = $selling_priceErr = $message = "";
    $product = array();
    $product_update = array();

    require_once "Controller/displayProductController.php";
    $obj = new getInfo();
    if (!empty($obj->get())) {
        $product = $obj->get();
    }

    if (!empty($product)) {
        foreach ($product as $row) {
            $need = array(
                "name" => "",
                "selling_price" => 0,
                "buying_price" => 0,
                "profit" => 0
            );
            $need["name"] = $row["name"];
            $need["selling_price"] = $row["selling_price"];
            $need["buying_price"] = $row["buying_price"];
            $need["profit"] = $row["selling_price"] - $row["buying_price"];
            array_push($product_update, $need);
        }
    }


    ?>
    <div class="split-screen">
        <?php include 'client_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">

            <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                <?php
                if (isset($_COOKIE["delete_message"])) {
                    echo $_COOKIE["delete_message"]."<br>";
                }
                ?>
            </span>
            <h1>Information:</h1>

            <table class="info">
                <tr>
                    <th>Name</th>
                    <th>Profit</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php foreach ($product_update as $row) : ?>
                    <tr>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["profit"]; ?></td>
                        <td><a class="linkTag" href="edit_product.php?name=<?php echo $row["name"] ?>">Edit</a>
                        <td><a class="linkTag" href="delete_product.php?name=<?php echo $row["name"] ?>">Delete</a>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>