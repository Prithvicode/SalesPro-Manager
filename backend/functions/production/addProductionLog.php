<?php
// addProductionLog.php

include '../../../backend/db/dbconfig.php';

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if orderId is set in the POST request
    if (!isset($_SESSION['UserID'])) {
        echo "Error: UserID is not set in the session";
        exit(); // Exit the script if UserID is not set
    }

    // Get the raw POST data
    $rawData = file_get_contents("php://input");
    
    // Decode the JSON data into a PHP associative array
    $postData = json_decode($rawData, true);
    
    // Check if orderId exists in the POST data
    if (!isset($postData['orderId'])) {
        echo "Error: orderId is not set in the POST data";
        exit(); // Exit the script if orderId is not set
    }
    
    $orderId = $postData['orderId'];
    
    // Query the database to get order items
    $orderItemsSql = "SELECT * FROM orderItems WHERE OrderID = '$orderId'";
    $orderItemsResult = mysqli_query($conn, $orderItemsSql);

    if ($orderItemsResult) {
        while ($row = mysqli_fetch_assoc($orderItemsResult)) {
            // Insert a record into the ProductionLog table
            $productId = $row['ProductID'];
            $productionDate = date('Y-m-d'); // Current date
            $quantityProduced = $row['Quantity'];
            $productionStaffId = $_SESSION['UserID']; // Get UserID from session

            // Insert production log into the database
            $insertProductionLogSql = "INSERT INTO ProductionLog (ProductID, ProductionDate, QuantityProduced, ProductionStaffID,OrderID) VALUES ('$productId', '$productionDate', '$quantityProduced', '$productionStaffId', '$orderId')";
            $insertResult = mysqli_query($conn, $insertProductionLogSql);

            // Handle insertion result if needed
        }

        // Provide a response indicating success or failure
        if ($insertResult) {
            echo "Production logs added successfully";
        } else {
            echo "Failed to add production logs";
        }
    } else {
        echo "Error fetching order items";
    }
}
?>
