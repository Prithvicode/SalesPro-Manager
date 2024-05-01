<?php
include '../../../backend/db/dbconfig.php';

session_start();
$productID= $_GET['productId'];

// GET THE PRODUCT DETAILS
$getProduct = "select * from products where ProductID = $productID";
$getResult = mysqli_query($conn, $getProduct);

if($getResult){
    $product = mysqli_fetch_assoc($getResult);
           
}


?>


<head>
        <link rel="stylesheet" href='../../components/tables/orderDetailsTable.css' />
        <link rel="stylesheet" href='../../components/popups/popup.css' />
         <link rel="stylesheet" href='../../components/forms/insertProduct.css' />
</head>

     <form action="" method="" enctype="multipart/form-data">
    <label for="productName">Product Name:</label><br>
    <input type="text" id="productName" name="productName" value="<?php echo $product['ProductName']; ?>" required><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description"><?php echo $product['Description']; ?></textarea><br>

    <label for="sku">SKU:</label><br>
    <select id="sku" name="sku">
        <option value="pieces" <?php if($product['SKU'] == 'pieces') echo 'selected'; ?>>Pieces</option>
        <option value="kg" <?php if($product['SKU'] == 'kg') echo 'selected'; ?>>Kilograms (kg)</option>
        <option value="ltr" <?php if($product['SKU'] == 'ltr') echo 'selected'; ?>>Liters (ltr)</option>
    </select>

     <label for="costPrice">Cost Price:</label><br>
        <input type="number" id="costPrice" value="<?php echo $product['CostPrice']; ?>" name="costPrice" step="0.01" required><br>

        <label for="sellingPrice">Selling Price:</label><br>
        <input type="number" id="sellingPrice" value="<?php echo $product['SellingPrice']; ?>" name="sellingPrice" step="0.01" required><br>
    <br>

    <!-- Add other input fields and set their values similarly -->

    <input type="submit" value="Submit">
</form>

 <script>
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this); // Create FormData object to send form data

        fetch('http://localhost/InventoryAndSalesManagement/backend/functions/product/updateProduct.php?productId=<?php echo $productID?>', {
            method: 'POST',
            body: formData
        })
         .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log(data); // Log the response from the server
            // You can perform additional actions based on the response
            alert(data);
            window.location.reload() // Show an alert if added successfully

        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            alert("Insert failed"); // Show an alert if insertion failed
        });
    });
});

 </script>