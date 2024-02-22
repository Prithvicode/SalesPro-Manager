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

// print_r(getSalesDetailsFromOrderId($conn,20));

?>