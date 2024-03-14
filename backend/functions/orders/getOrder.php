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

    $orderSql = "SELECT * FROM orders WHERE CustomerID = '$customerId' ORDER BY OrderID DESC; ";
    $result  = mysqli_query($conn, $orderSql);
    if($result){
        if(mysqli_num_rows($result) > 0 ){
           while($row = mysqli_fetch_assoc($result)){
            $customerOrders[] = [
                $row['OrderDate'],
                $row['OrderID'],
                $row['VerificationStatus'],
                 $row['ProductionStatus'],
                $row['DeliveryStatus']
               
            ];
           }

        }
    }
    return $customerOrders;
}
// print_r(getCustomerOrder($conn,2));

// GET ORDERS FOR CUSTOMER DASHBOARD;
function getCustomerDashboardData($conn,$customerId){ 
    $sql = "SELECT 
    COUNT(*) AS total_orders,
    SUM(CASE WHEN VerificationStatus = 'Pending' THEN 1 ELSE 0 END) AS pending_orders,
    SUM(CASE WHEN VerificationStatus = 'Verified' THEN 1 ELSE 0 END) AS verified_orders,
    SUM(CASE WHEN VerificationStatus = 'Cancelled' THEN 1 ELSE 0 END) AS cancelled_orders,
    SUM(CASE WHEN ProductionStatus = 'Started' THEN 1 ELSE 0 END) AS started_production,
    SUM(CASE WHEN DeliveryStatus = 'In Transit' THEN 1 ELSE 0 END) AS in_transit_delivery,
    SUM(CASE WHEN DeliveryStatus = 'Delivered' THEN 1 ELSE 0 END) AS delivered_orders
    FROM orders
    WHERE CustomerID = '$customerId';";

    $result  = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0 ){
           while($row = mysqli_fetch_assoc($result)){
            $customerOrderTotals= array(
            "total_orders" => $row['total_orders'],
            "pending_orders" => $row['pending_orders'],
            "verified_orders" => $row['verified_orders'],
            "cancelled_orders" => $row['cancelled_orders'],
            "started_production" => $row['started_production'],
            "in_transit_delivery" => $row['in_transit_delivery'],
            "delivered_orders" => $row['delivered_orders']
        );
           }

        }
    }

    return $customerOrderTotals;

}



?>