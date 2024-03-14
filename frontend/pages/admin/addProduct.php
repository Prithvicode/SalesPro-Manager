<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'Admin'){
    echo 'Access Denied';
    
}
else{

// Base URL for images
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products </title>
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
    <link rel="stylesheet" href='../../components/popups/popup.css' />
    <link rel="stylesheet" href='../../components/tables/table.css' />
    <link rel="stylesheet" href='../../components/forms/addprod.css' />
   
</head>
 
<body>
<div class="container">
<?php
   include '../../components/sidebar/adminSidebar.php'; 
  
?>
<main>
      <div class="header">
        <h2>Products</h2>
        <!-- <div class="date">
          <input type="date" />
        </div> -->
      </div>

      <div class="product-container">
        <button id ='addProdBtn'>&plus; Add Product</button>
       <table id ='productTableBody'>
        <thead>
        <th>S.No</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>SKU</th>
        <th>Cost Price</th>
        <th>Selling Price</th>
        <th colspan= 2>Actions</th>
        </thead>

        <?php


        ?>




       </table>

      </div>
   
   
    <div class="modelPopup">

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
  </div>
   <script>
    const productTableBody = document.getElementById('productTableBody');

    fetch('http://localhost/InventoryAndSalesManagement/backend/functions/product/getProduct.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(products => {
        products.forEach((product, index) => {
            const row = document.createElement("tr")
            row.innerHTML = `
              
                    <td>${index + 1}</td>
                    <td>${product.ProductName}</td>
                    <td>${product.Description}</td>
                    <td>${product.SKU}</td>
                    <td>${product.CostPrice}</td>
                    <td>${product.SellingPrice}</td>
                    <td><a href= "#" class ='editBtn'> Edit </a></td>
                    <td><a href= "#" class ='deleteBtn'>Delete</a></td>

                    
               
            `;

            productTableBody.appendChild(row);
            
        });
    });
</script>
</body>
</html>

<?php
}?>