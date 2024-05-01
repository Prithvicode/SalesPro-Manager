<?php

include '../../db/dbconfig.php';

$productId = $_GET['productId'];

$delete = "Delete from products where ProductID = $productId";

$result = mysqli_query($conn,$delete);
if($result){
    echo "Successfully Deleted";
}else{
    echo "Product is reference in the Orders.Cannot be deleted.";
}

?>