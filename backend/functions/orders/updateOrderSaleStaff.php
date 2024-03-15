<?php

include '../../db/dbconfig.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){

$data = json_decode(file_get_contents("php://input"));
 if (isset($data->id, $data->statusType, $data->statusValue)) {
        // Call the updateOrderStatus function with the provided data
        updateOrderStatus($conn, $data->id, $data->statusType, $data->statusValue);
    } else {
        // Return an error message if any required data is missing
        echo "Missing required data";
    }

}





   
function updateOrderStatus($conn, $orderId,$statusType, $statusValue){
    $prodStartBtnSql = "UPDATE orders set $statusType = '$statusValue' where OrderID = '$orderId'";
    $result = mysqli_query($conn, $prodStartBtnSql);
    if($result){
        // echo  $statusType ." ".'changed to'." ".$statusValue;
    }

                           

}                     
                              
                            

?>