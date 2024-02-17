<?php
session_start();

include '../../db/dbconfig.php';
include 'getOrder.php';
include 'createOrderItems.php';


// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $rawData = file_get_contents("php://input");
    
    // Decode the JSON data into a PHP associative array
    $postData = json_decode($rawData, true);

    // Get order details
    $currentDate = $postData['currentDate'];
    $expectedDate = $postData['expectedDate'];
    $paymentType = $postData['paymentType'];

    // Get product items details
    $orderItemDetails = $postData['orderItemDetails'];


    // customer ID
    $customerId = $postData['customerId'];
    

    // Create Order
    $insertOrderQuery = "INSERT INTO orders(CustomerID, OrderDate, DeliveryDate) 
                        VALUES ('$customerId', '$currentDate', '$expectedDate')";

    $insertResult = mysqli_query($conn, $insertOrderQuery);
    if ($insertResult) {
    // If successfully inserted then
     
    // Get Latest Order id
    $orderId = getLatestOrderId($conn);

    // post Order item details with order id
    $message = insertOrderItems($conn, $orderId, $orderItemDetails);


    // Create a response array
       $response = array(
        "message" => $message
    );


    } else {
        echo "Error: " . mysqli_error($conn); // Display error if query fails
    }

   
   
    // Encode the response array as JSON and echo it
    echo json_encode($response);
}
?>
