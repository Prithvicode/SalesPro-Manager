<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'Admin'){
    echo "Access Denied";

}
else {
   

 include '../../components/adminNav.php';
 ?>

<style>
    .hero{
        display:flex;
    }
</style>
<div class="hero">


 <?php
 include '../../components/adminSidebar.php';
?>

<h1>Inventory</h1>
<table>
    <tr>
        <th>Product No</th>
        <th>Product Name</th>
        <th>Available Stocks</th>
    </tr>
</table>

<script>
     // Fetch Product data for drop down options
    const productNameInput = productItem.querySelector("#productName");

    let productPrices = {};

    const url =
      "http://localhost/InventoryAndSalesManagement/backend/functions/product/getProduct.php";

    const options = {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    };
    fetch(url, options)
      .then((response) => response.json())
      .then((data) => {
        data.forEach((item) => {
          productPrices[item.ProductID] = item.SellingPrice; // store price values
          const option = document.createElement("option");
          option.value = item.ProductID;
          option.textContent = item.ProductName;
          productNameInput.appendChild(option);
        });
      });

</script>




<?php
}

