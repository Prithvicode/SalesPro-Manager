<?php


function addDeliveryDetailsForOrders($conn,$details, $orderID){
$phoneNo = $details['phoneNumber'];
 $deliveryCity= $details['deliveryCity'];
$deliveryAddress = $details['deliveryAddress'];
$deliveryInstructions = $details['deliveryInstructions'];

    $insertDelivery = "INSERT into deliveryDetails
    (phoneNumber,deliveryCity,deliveryAddress, deliveryInstructions,orderID) values (
        '$phoneNo',
        '$deliveryCity',
        '$deliveryAddress',
        '$deliveryInstructions',
        $orderID
        )";

    $result = mysqli_query($conn, $insertDelivery);

    if($result){
        


    }else{
        
    }

}



?>