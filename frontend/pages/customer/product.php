<?php 
session_start();
if(!isset($_SESSION['UserID'])){
    header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if($_SESSION['UserType'] != 'Customer'){
    echo "Access Denied";
} else {
    // GET ORDER FUNCTIONS
    include '../../../backend/db/dbconfig.php';
    include '../../../backend/functions/orders/getOrder.php';
    include '../../../backend/functions/orders/getOrderItems.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link rel="stylesheet" href='../../components/tables/table.css' />
     <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
     <link rel="stylesheet" href='statusStyle.css' />
  
     
 <style>
       
.frame-wrapper{
    /* background-color:aqua; */
    height:90%;
    display:flex;
    /* flex-direction:column; */
    /* top:10; */
    align-items: center;
    justify-content:center;
}
 </style>
</head>
<body>
   <div class="container">
<?php
   include '../../components/sidebar/customerSidebar.php'; 
?>

        <!-- Main Content -->
        <main class="main-content" style='width:100%'>
             <div class="header">
        <h2>Available Products</h2>
        
      </div>
  <div class="table-container">
                <table border="1" id ='productTableBody'>
                    <tr>
                    <th>S.No</th>
                    <th>Product Name</th>
                    <th >Description</th>
                    <th>SKU</th>
                    <th> Price</th>
                    
                    </tr>
                     </table>


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
                    <td>${product.SellingPrice}</td>
                   
               
            `;

            productTableBody.appendChild(row);
            
        });
    });
</script>
</script>
<?php

}?>