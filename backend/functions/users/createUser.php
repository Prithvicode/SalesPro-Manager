<?php

include '../../db/dbconfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['mail'];
    $userType = $_POST['UserType'];
    $phone = $_POST['Phone'];
    $address = $_POST['Address'];
    $passw = $_POST['passw'];

    // Hash the password
    $hashedPassword = password_hash($passw, PASSWORD_DEFAULT);


    // Check if the user email exits or not
    $checkMail = "select * from users where Email = '$email' or PhoneNumber ='$phone'";
    $checkResult = mysqli_query($conn, $checkMail);
    if(mysqli_num_rows($checkResult)>0){
        // it exists
        echo "User Email or Phone number already taken.";
    }
    else{
    $addUserQuery = "INSERT INTO users 
                    (FirstName, LastName, 
                    Email, UserType, 
                    PhoneNumber, Address, PasswordHash) 
                    VALUES ('$firstName', 
                    '$lastName', '$email', 
                    '$userType', '$phone',
                    '$address', '$hashedPassword')";

    $result = mysqli_query($conn, $addUserQuery);
    if ($result) {
        echo "Added successfully";
    } else {
        echo 'Insert failed';
    }
}
}
?>
