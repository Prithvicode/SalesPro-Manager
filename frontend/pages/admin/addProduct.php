<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'Admin'){
    echo 'Access Denied';
    
}
else{




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form 
    action="http://localhost/InventoryAndSalesManagement/backend/functions/product/createProduct.php" 
    method="post" 
    enctype="multipart/form-data">
        <label for="productName">Product Name:</label><br>
        <input type="text" id="productName" name="productName" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>

        <label for="sku">SKU:</label><br>
       <select id="sku" name="sku">
            <option value="pieces">Pieces</option>
            <option value="kg">Kilograms (kg)</option>
            <option value="ltr">Liters (ltr)</option>
        </select>
        <br>
        <label for="productionTime">Production Time (Days):</label><br>
        <input type="number" id="productionTime" name="productionTime" required><br>

        <label for="costPrice">Cost Price:</label><br>
        <input type="number" id="costPrice" name="costPrice" step="0.01" required><br>

        <label for="sellingPrice">Selling Price:</label><br>
        <input type="number" id="sellingPrice" name="sellingPrice" step="0.01" required><br>

        <label for="inventoryLevel">Inventory Level:</label><br>
        <input type="number" id="inventoryLevel" name="inventoryLevel" required><br>

        <label for="productImage">Product Image:</label><br>
        <input type="file" id="productImage" name="productImage"><br><br>

        <input type="submit" value="Submit">
    </form>
    <!-- <script>
          document.getElementById('addProductForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Create a FormData object to store form data
            var formData = new FormData(this);

            // Make a fetch request to your server
            fetch('your_server_url_here', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                // You can handle success response here, e.g., show a success message
            })
            .catch(error => {
                console.error('Error:', error);
                // You can handle error response here, e.g., show an error message
            });
        });
    </script> -->
</body>
</html>

<?php
}?>