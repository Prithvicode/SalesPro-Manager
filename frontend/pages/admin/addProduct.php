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
    <link rel="stylesheet" href='../../components/forms/addprod.css' />
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
    <link rel="stylesheet" href='../../components/popups/popup.css' />
    <link rel="stylesheet" href='../../components/tables/table.css' />
    
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
       <div id="orderDetailFrame" class = "modal" style="display: none;">
                    <!-- Close button for the iframe -->
                    <span id="closeFrame">&times;</span><br>
                    <div class="frame-wrapper">
                    <!-- <button id="closeFrame">Close</button><br> -->

                    <iframe id="iframeContent" class = "modal-content">
                     

                    </iframe>

                    </div>
                    
                </div>
        </main>
   </div>
    
   <script>
    // Delete functinality:
    // Function to handle product deletion confirmation
    function confirmDelete(productId) {
    if (confirm("Are you sure you want to delete?")) {
        // Send fetch request to delete product
        fetch(`http://localhost/InventoryAndSalesManagement/backend/functions/product/deleteProduct.php?productId=${productId}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (response.ok) {
                // Reload the page after successful deletion
                location.reload();
            } else {
                // Handle error, maybe show a message to the user
                console.error('Failed to delete product');
            }
            return response.text(); // Parse response as text
        })
        .then(message => {
            // Display the message returned from the backend
            alert(message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

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
                    <td><a href= "#" class ='editBtn'  data-productid="${product.ProductID}"> Edit </a></td>
                    <td><a onclick="confirmDelete(${product.ProductID})" class ='deleteBtn'>Delete</a></td>
                   
            `;

            productTableBody.appendChild(row);
            
        });
    });
</script>
<script>
 
  const addProdModel = document.getElementById("modelPopup");



 // Show iframe for the product form
      document.addEventListener("DOMContentLoaded", function () {
    const addProdBtn = document.getElementById("addProdBtn");
    const editBtn = document.getElementById("editBtn");
    const iframeContainer = document.getElementById("orderDetailFrame");
    const closeIframeButton = document.getElementById("closeFrame");
    const iframeContent = document.getElementById("iframeContent");

      // Show Add product Form:
      addProdBtn.addEventListener("click",function(){
        iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/admin/addProductForm.php`;
        iframeContainer.style.display = "block"; // Show iframe container

      })
// EDIT

   
        // Show iframe for updateProduct page when Edit button is clicked
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains('editBtn')) {
                event.preventDefault();
                const productId = event.target.getAttribute("data-productid");
                const iframeContainer = document.getElementById("orderDetailFrame");
                const iframeContent = document.getElementById("iframeContent");
                iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/admin/updateProduct.php?productId=${productId}`;
                iframeContainer.style.display = "block";
            }
        });

        




        closeIframeButton.addEventListener("click", function () {
        iframeContainer.style.display = "none"; // Hide iframe container
        iframeContent.src = "";// Reset iframe src

        location.reload(); 
    });
});



</script>
</body>
</html>

<?php
}?>