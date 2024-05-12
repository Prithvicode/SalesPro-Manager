<?php
session_start();

?>


<head>
        <link rel="stylesheet" href='../../components/tables/orderDetailsTable.css' />
        <link rel="stylesheet" href='../../components/popups/popup.css' />
        <link rel="stylesheet" href='../../components/forms/insertProduct.css' />
</head>

      <form 
    action="" 
    method="" 
    enctype="multipart/form-data">
        <label for="productName">Product Name:</label><br>
        <input type="text" id="productName" name="productName" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br>

        <label for="sku">SKU:</label><br>
       <select id="sku" name="sku">
            <option value="pieces">Pieces</option>
            <option value="kg">Kilograms (kg)</option>
            <option value="ltr">Liters (ltr)</option>
        </select>
        <br>
        <!-- <label for="productionTime">Production Time (Days):</label><br> -->
        <!-- <input type="number" id="productionTime" name="productionTime" required><br> -->

        <label for="costPrice">Cost Price:</label><br>
        <input type="number" id="costPrice" name="costPrice" step="0.01" min = 1 required><br>

        <label for="sellingPrice">Selling Price:</label><br>
        <input type="number" id="sellingPrice" name="sellingPrice" step="0.01" min = 1 required><br>

        <!-- <label for="inventoryLevel">Inventory Level:</label><br>
        <input type="number" id="inventoryLevel" name="inventoryLevel" required><br> -->

        <!-- <label for="productImage">Product Image:</label><br>
        <input type="file" id="productImage" name="productImage"><br><br> -->

        <input type="submit" value="Submit">
    </form>
 <script>
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this); // Create FormData object to send form data

        fetch('http://localhost/InventoryAndSalesManagement/backend/functions/product/createProduct.php', {
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