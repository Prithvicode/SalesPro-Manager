<?php

// include '../../db/dbconfig.php';


function getSalesDetailsFromOrderId($conn, $orderId){
  
    
    $salesSql = "SELECT * FROM sales where OrderID =$orderId";
    $result = mysqli_query($conn, $salesSql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){

              $sales = array(
                'SalesID' => $row['SalesID'],
                'OrderID' => $row['OrderID'],
                'SalesStaffID' => $row['SalesStaffID'],
                'SalesTimestamp' => $row['SalesTimestamp'],
                'MoneyReceived' => $row['MoneyReceived'],
                'ProfitMade' => $row['ProfitMade'],
                'PaymentType' => $row['PaymentType'],
                'TotalAmount' => $row['TotalAmount']
            );           

        }    
        
    }
    return $sales;

}
function getRecentSales($conn){
    $salesSql = "SELECT 
                    orders.*, 
                    CONCAT(users.FirstName, ' ', users.LastName) AS CustomerName,
                    sales.*
                FROM 
                    orders
                JOIN 
                    users ON orders.CustomerID = users.UserID
                JOIN
                    (SELECT * FROM sales ORDER BY SalesID DESC LIMIT 5) AS sales
                ON
                    orders.OrderID = sales.OrderID;";
    
    $result = mysqli_query($conn, $salesSql);
    $sales = array(); // Initialize an empty array to store sales data
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sales[] = array(
                'SalesID' => $row['SalesID'],
                'CustomerName' => $row['CustomerName'],
                'DeliveryStatus' => $row['DeliveryStatus'],
                'SalesTimestamp' => $row['SalesTimestamp'],
                'MoneyReceived' => $row['MoneyReceived'],
                'ProfitMade' => $row['ProfitMade'],
                'PaymentType' => $row['PaymentType'],
                'TotalAmount' => $row['TotalAmount']
            );           
        }    
    }
    return $sales;
}


// print_r(getSalesDetailsFromOrderId($conn,20));
function getSalesAdminDashboard($conn){
       // Calculate Sales, Profit, Revenue
      $salesTotals = array();

        // SQL query to get total sales and total profit
        $sql = "SELECT count(distinct orderID) as total_sales_number,SUM(TotalAmount) AS total_sales, SUM(ProfitMade) AS total_profit FROM sales";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $salesData = mysqli_fetch_assoc($result);
            $salesTotals['total_sales'] = $salesData['total_sales'];
            $salesTotals['total_profit'] = $salesData['total_profit'];
            $salesTotals['total_sales_number'] = $salesData['total_sales_number'];
        } else {
            // Handle error if query fails
            $salesTotals['total_sales'] = 0;
            $salesTotals['total_profit'] = 0;
            $salesTotals['total_sales_number'] = 0;
        }
        return $salesTotals;
}

 function getSalesStaffDashboard($conn,$staffID){

   $salesTotals = array();

        // SQL query to get total sales and total profit
        $sql = "SELECT SUM(TotalAmount) AS total_sales, SUM(ProfitMade) AS total_profit FROM sales where SalesStaffID = '$staffID'";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $salesData = mysqli_fetch_assoc($result);
            $salesTotals['total_sales'] = $salesData['total_sales'];
            $salesTotals['total_profit'] = $salesData['total_profit'];
        } else {
            // Handle error if query fails
            $salesTotals['total_sales'] = 0;
            $salesTotals['total_profit'] = 0;
        }
        return $salesTotals;
}

?>