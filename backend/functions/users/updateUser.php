<?php
include '../../db/dbconfig.php';

$userID = $_GET['userId'];
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $userType = $_POST['userType'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
  
    // Add other form fields here

    // Assuming you have sanitized the input to prevent SQL injection

    // Prepare SQL statement to update user details
    $updateSql = "UPDATE users SET FirstName = '$firstName', LastName = '$lastName', Email = '$email', UserType = '$userType', PhoneNumber ='$phone', Address ='$address' WHERE UserID = $userID";

    // Execute SQL query
    $result = mysqli_query($conn, $updateSql);

    // Check if update was successful
    if ($result) {
        echo "User details updated successfully";
    } else {
        echo "Error updating user details: " . mysqli_error($conn);
    }
}
?>
