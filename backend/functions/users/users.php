<?php
include '../../db/dbconfig.php';

$requestedUser = [];

if(!isset($_GET['UserID'])){
    // get All users
    $getAllUsers = "SELECT * FROM users WHERE UserType IN ('Admin', 'SalesStaff', 'ProductionStaff');";
    $getResult = mysqli_query($conn, $getAllUsers );
   


}else{
    $id =  $_GET['UserID'];
    $getUserQuery = "SELECT * FROM users where UserID =$id";
    $getResult = mysqli_query($conn,$getUserQuery );
}

 while($row = mysqli_fetch_assoc($getResult)){
    $requestedUser[] = $row;
 }

// Send the data as JSON
header('Content-Type: application/json');
echo json_encode($requestedUser);





?>