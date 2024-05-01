<?php
include '../../db/dbconfig.php';

$productID = $_GET['productId'];
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $sku = $_POST['sku'];
    $costPrice = $_POST['costPrice'];
    $sellingPrice = $_POST['sellingPrice'];
    // Add other form fields here

    // Assuming you have sanitized the input to prevent SQL injection

    // Prepare SQL statement to update product details
    $updateSql = "UPDATE products SET ProductName = '$productName', Description = '$description', SKU = '$sku', CostPrice = '$costPrice', SellingPrice ='$sellingPrice' WHERE ProductID = $productID";

    // Execute SQL query
    $result = mysqli_query($conn, $updateSql);

    // Check if update was successful
    if ($result) {
        echo "Product details updated successfully";
    } else {
        echo "Error updating product details: " . mysqli_error($conn);
    }
}
?>
