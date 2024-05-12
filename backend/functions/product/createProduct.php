<?php

include '../../db/dbconfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $sku = $_POST['sku'];
    $costPrice = $_POST['costPrice'];
    $sellingPrice = $_POST['sellingPrice'];

    // check if product Already exists or not
    $productNameSql = "SELECT * FROM products WHERE ProductName = '$productName'";
    $productResult = mysqli_query($conn, $productNameSql);

    if(mysqli_num_rows($productResult) > 0) {
        echo "Product Already Exists";
    } else {
        $addProductQuery = "INSERT INTO products (ProductName, Description, SKU, CostPrice, SellingPrice)
                            VALUES ('$productName', '$description', '$sku', '$costPrice', '$sellingPrice')";

        $result = mysqli_query($conn, $addProductQuery);
        
        if($result) {
            echo "Added successfully";
        } else {
            echo 'Insert failed';
        }
    }
}
?>
