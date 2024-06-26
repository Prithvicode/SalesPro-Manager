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


// Orders Data for admin dashb
function getAdminDashboardData($conn){ 
    $sql = "SELECT 
    COUNT(*) AS total_orders,
    SUM(CASE WHEN VerificationStatus = 'Pending' THEN 1 ELSE 0 END) AS pending_orders,
    SUM(CASE WHEN VerificationStatus = 'Verified' THEN 1 ELSE 0 END) AS verified_orders,
    SUM(CASE WHEN VerificationStatus = 'Cancelled' THEN 1 ELSE 0 END) AS cancelled_orders,
    SUM(CASE WHEN ProductionStatus = 'Started' THEN 1 ELSE 0 END) AS started_production,
    SUM(CASE WHEN DeliveryStatus = 'In Transit' THEN 1 ELSE 0 END) AS in_transit_delivery,
    SUM(CASE WHEN DeliveryStatus = 'Delivered' THEN 1 ELSE 0 END) AS delivered_orders
    FROM orders";

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

function getAdminDashboardDataFromDate($conn, $date){ 
    $customerOrderTotals = array(); // Initialize the array
    // Query for orders
    $sql = "SELECT 
                COUNT(DISTINCT o.OrderID) AS total_orders,
                SUM(CASE WHEN o.VerificationStatus = 'Pending' THEN 1 ELSE 0 END) AS total_pending,
                SUM(CASE WHEN o.VerificationStatus = 'Cancelled' THEN 1 ELSE 0 END) AS total_cancelled,
                SUM(CASE WHEN o.DeliveryStatus = 'Delivered' THEN 1 ELSE 0 END) AS total_delivered
            FROM 
                orders o
            WHERE 
                DATE(o.OrderDate) = '$date'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $customerOrderTotals = array(
            "total_orders" => $row['total_orders'],
            "total_pending" => $row['total_pending'],
            "total_cancelled" => $row['total_cancelled'],
            "total_delivered" => $row['total_delivered']
        );
    }

    // Query for sales
    $sql_sales = "SELECT 
                    COUNT(DISTINCT s.OrderID) AS total_sales,
                    SUM(oi.Price) AS total_cost_price,
                    SUM(s.ProfitMade) AS total_profit
                FROM 
                    sales s
                LEFT JOIN 
                    orders o ON s.OrderID = o.OrderID
                LEFT JOIN 
                    orderitems oi ON o.OrderID = oi.OrderID
                WHERE 
                    DATE(s.SalesTimestamp) = '$date'
                    AND o.DeliveryStatus = 'Delivered'";

    $result_sales = mysqli_query($conn, $sql_sales);

    if ($result_sales && mysqli_num_rows($result_sales) > 0) {
        $row_sales = mysqli_fetch_assoc($result_sales);
        $customerOrderTotals["total_sales"] = $row_sales["total_sales"];
        $customerOrderTotals["total_cost_price"] = $row_sales["total_cost_price"];
        $customerOrderTotals["total_profit"] = $row_sales["total_profit"];
    }

    return $customerOrderTotals;
}


function getOrderForSalesDashboard($conn,$salesStaffID){
      $sql = "SELECT 
    COUNT(*) AS total_orders,
    SUM(CASE WHEN VerificationStatus = 'Pending' THEN 1 ELSE 0 END) AS pending_orders,
    SUM(CASE WHEN VerificationStatus = 'Verified' THEN 1 ELSE 0 END) AS verified_orders,
    SUM(CASE WHEN VerificationStatus = 'Cancelled' THEN 1 ELSE 0 END) AS cancelled_orders,
    SUM(CASE WHEN DeliveryStatus = 'Not Delivered' THEN 1 ELSE 0 END) AS assigned_orders,
    SUM(CASE WHEN DeliveryStatus = 'In Transit' THEN 1 ELSE 0 END) AS in_transit_delivery,
    SUM(CASE WHEN DeliveryStatus = 'Delivered' THEN 1 ELSE 0 END) AS delivered_orders
    FROM orders where AssignedDeliveryStaffID = $salesStaffID";

    $result  = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0 ){
           while($row = mysqli_fetch_assoc($result)){
            $customerOrderTotals= array(
            "assigned_orders" => $row['assigned_orders'],
            "pending_orders" => $row['pending_orders'],
            "verified_orders" => $row['verified_orders'],
            "cancelled_orders" => $row['cancelled_orders'],
            "in_transit_delivery" => $row['in_transit_delivery'],
            "delivered_orders" => $row['delivered_orders']
        );
           }

        }
    }

    return $customerOrderTotals;
}

function getProductionDashboardData($conn){
    $sql = "SELECT 
        COUNT(*) AS total_orders,
        SUM(CASE WHEN ProductionStatus = 'Not Started' AND VerificationStatus = 'Verified' THEN 1 ELSE 0 END) AS not_started_production,
        SUM(CASE WHEN ProductionStatus = 'Started' THEN 1 ELSE 0 END) AS started_production,
        SUM(CASE WHEN ProductionStatus = 'Completed' THEN 1 ELSE 0 END) AS completed_production,
        SUM(CASE WHEN VerificationStatus = 'Verified' THEN 1 ELSE 0 END) AS verified_orders
        FROM orders";

    $result  = mysqli_query($conn, $sql);
    $productionData = array();

    if($result){
        if(mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_assoc($result)){
                // Store the production data in an associative array
                $productionData = array(
                    "not_started_production" => $row['not_started_production'],
                    "started_production" => $row['started_production'],
                    "completed_production" => $row['completed_production'],
                    "verified_orders" => $row['verified_orders']
                );
            }
        }
    }

    return $productionData;
}


function getProductionDashboardDataFromDate($conn, $date){
    $sql = "SELECT 
        COUNT(*) AS total_orders,
        SUM(CASE WHEN ProductionStatus = 'Not Started' and VerificationStatus = 'Verified' THEN 1 ELSE 0 END) AS not_started_production,
        SUM(CASE WHEN ProductionStatus = 'Started' THEN 1 ELSE 0 END) AS started_production,
        SUM(CASE WHEN ProductionStatus = 'Completed' THEN 1 ELSE 0 END) AS completed_production,
        SUM(CASE WHEN VerificationStatus = 'Verified' THEN 1 ELSE 0 END) AS verified_orders
        FROM orders where OrderDate = '$date'";

    $result  = mysqli_query($conn, $sql);
    $productionData = array();

    if($result){
        if(mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_assoc($result)){
                // Store the production data in an associative array
                $productionData = array(
                    "total_orders" => $row['total_orders'],
                    "not_started_production" => $row['not_started_production'],
                    "started_production" => $row['started_production'],
                    "completed_production" => $row['completed_production'],
                    "verified_orders" => $row['verified_orders']
                );
            }
        }
    }

    return $productionData;
}
?>