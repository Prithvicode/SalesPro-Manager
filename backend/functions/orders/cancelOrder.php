<?php
session_start();
include '../../db/dbconfig.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $rawData = file_get_contents("php://input");
    
    // Decode the JSON data into a PHP associative array
    $postData = json_decode($rawData, true);

    // Check if decoding was successful
    if ($postData === null) {
        // Handle JSON decoding error
        $response = array(
            "error" => "JSON decoding error"
        );
        echo json_encode($response);
        exit; // Stop further execution
    }

    // Check if the required keys exist in the $postData array
    if (!isset($postData['orderID'], $postData['cancelDate'], $postData['reason'])) {
        // Handle missing keys error
        $response = array(
            "error" => "Missing required keys in JSON data"
        );
        echo json_encode($response);
        exit; // Stop further execution
    }

    // Get order details
    $orderId = $postData['orderID'];
    $cancelDate = $postData['cancelDate'];
    $cancelReason = $postData['reason'];

    // Insert into cancellation history table
    $insertQuery = "INSERT INTO cancellationhistory(OrderID, CancellationTimestamp, Reason) 
                    VALUES ('$orderId', '$cancelDate', '$cancelReason')";

    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        // Change order status to cancelled. 
        $msg =  updateOrderStatus($conn, $orderId, 'VerificationStatus', 'Cancelled');
    }

    // Create a response array
    $response = array(
        "message" => $msg
    );

    echo json_encode($response);
}

function updateOrderStatus($conn, $orderId, $statusType, $statusValue){
    $prodStartBtnSql = "UPDATE orders SET $statusType = '$statusValue' WHERE OrderID = '$orderId'";
    $result = mysqli_query($conn, $prodStartBtnSql);

    if ($result) {
        $msg = "Order has been Cancelled.";
    } else {
        $msg = "Failed to update order status";
    }

    return $msg;
}
?>
