<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Search Product</title>
</head>


<body>
    <?php
    session_start();
    if (isset($_SESSION["name"])) {
        session_destroy();
    }
    $key  =  $message = "";
    $product = array();
    $product_update = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $key=$_POST["key"];
        require_once "Controller/searchProductController.php";
        $obj = new search();
        if (!empty($obj->search_product($_POST["key"]))) {
            $product = $obj->search_product($_POST["key"]);
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
    }


    ?>
    <div class="split-screen">
        <?php include 'client_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">
            <span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
                <?php
                if (isset($_COOKIE["delete_message"])) {
                    echo $_COOKIE["delete_message"] . "<br>";
                }
                ?>
            </span>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="user_name">
                    <br>
                    <br>
                    <input type="text" name="key" class="input_style" placeholder="type here for search" value="<?php echo $key; ?>">
                </div>

                <div class="button">
                    <input type="submit" class="submit_button" value="Search">
                </div>
            </form>
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