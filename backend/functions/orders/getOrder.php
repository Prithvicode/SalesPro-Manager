<?php

// include '../../db/dbconfig.php';

function getLatestOrderId($conn){
    $latestSql = "SELECT OrderID FROM orders ORDER BY OrderID DESC LIMIT 1";
    $result = mysqli_query($conn, $latestSql);
    if($result){
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            return $row['OrderID'];

        }
    }
}
// echo getLatestOrderId($conn);
function getCustomerOrder($conn, $customerId){
    $customerOrders = array();

    $orderSql = "SELECT * from orders where CustomerID = '$customerId' ";
    $result  = mysqli_query($conn, $orderSql);
    if($result){
        if(mysqli_num_rows($result) > 0 ){
           while($row = mysqli_fetch_assoc($result)){
            $customerOrders[] = [
                $row['OrderDate'],
                $row['OrderID'],
                $row['VerificationStatus'],
                $row['DeliveryStatus'],
            ];
           }

        }
    }
    return $customerOrders;
}
// print_r(getCustomerOrder($conn,2));

?>