<?php

// include '../../db/dbconfig.php';

function getOrderItems($conn, $orderId){
    $requestedOrderItems = [];

    $getOrderItemSql = "SELECT * FROM orderItems WHERE OrderID = $orderId";

    $result = mysqli_query($conn, $getOrderItemSql);

    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $orderItem = array(
                'ProductID' => $row['ProductID'],
                'Price' => $row['Price'],
                'Quantity' => $row['Quantity'],
                'Amount' => $row['Amount']
            );

            $requestedOrderItems[] = $orderItem;
        }
    }

    return $requestedOrderItems;
}



// var_dump( getOrderItems($conn, 25));
?>