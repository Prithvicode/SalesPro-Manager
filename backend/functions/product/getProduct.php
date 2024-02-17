<?php

// session_start();
// if(!isset($_SESSION['UserID'])){
//        header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
// ;
// }

include '../../db/dbconfig.php';

$requestedProduct = [];

if(!isset($_GET['ProductId'])){
    // get All Products
    $getAllProductsQuery = "SELECT * FROM Products";
    $getResult = mysqli_query($conn, $getAllProductsQuery );
   


}else{
    $id =  $_GET['ProductId'];
    $getProductQuery = "SELECT * FROM Products where ProductID =$id";
    $getResult = mysqli_query($conn,$getProductQuery );
}

 while($row = mysqli_fetch_assoc($getResult)){
    $requestedProduct[] = $row;
 }

// Send the data as JSON
header('Content-Type: application/json');
echo json_encode($requestedProduct);



?>