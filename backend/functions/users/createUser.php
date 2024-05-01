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
?>
