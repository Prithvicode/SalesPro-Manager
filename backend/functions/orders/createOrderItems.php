<?php
// include '../../db/dbconfig.php';

function insertOrderItems($conn, $orderId, $orderItems){
    // $response = array(); // Initialize response array

    // Decode the JSON string into a PHP array
    // $orderItemDetails = json_decode($orderItems, true);

    foreach ($orderItems as $item) {
        // Extract individual item details
        $productId = $item['productId'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $amount = $item['amount'];

        // SQL query for inserting order items
        $sql = "INSERT INTO orderItems (OrderID, ProductID, Quantity, Price, Amount) VALUES (
            '$orderId',
            '$productId',
            '$quantity',
            '$price',
            '$amount'
        )";

        // Execute the SQL query
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            // Append success message to response array
            $response = "Successfully inserted";
        } else {
            // Append failure message to response array
            $response = "Failed to insert";
        }
    }
    return $response; // Return the response array
}




?>