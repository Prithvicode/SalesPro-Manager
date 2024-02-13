<?php

include '../../db/dbconfig.php';

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
?>