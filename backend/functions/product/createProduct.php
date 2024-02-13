<?php

include '../../db/dbconfig.php';


$productName = $_POST['productName'];
$description = $_POST['description'];
$sku = $_POST['sku'];
$productionTime = $_POST['productionTime'];
$costPrice = $_POST['costPrice'];
$sellingPrice = $_POST['sellingPrice'];
$inventoryLevel = $_POST['inventoryLevel'];


$productImageTempName = $_FILES['productImage']['name'];
$temp = $_FILES['productImage']['tmp_name'];
$folder = "../../assets/images/".$productImageTempName;
move_uploaded_file($temp,$folder);


$addProductQuery = "INSERT into products(ProductName, Description, SKU,
ProductionTimeDays ,CostPrice,SellingPrice ,InventoryLevel, ProductImage)
Values ('$productName',
        '$description',
        '$sku',
        '$productionTime', 
        '$costPrice',
        '$sellingPrice',
        '$inventoryLevel',
        '$folder')";

$result = mysqli_query($conn, $addProductQuery);
if($result){
     echo "<script>"."alert('Added successfully')"."</script>";
}
  else{
            echo 'insert failed';
        }


?>