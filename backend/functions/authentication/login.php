<?php
session_start(); // Start the session

if(isset($_POST['login'])){
    // importing config file
    include("../../db/dbconfig.php");

    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];

    $userQuery = "SELECT * FROM users where Email = '$inputEmail'";

    $userResult = mysqli_query($conn, $userQuery);

    if(mysqli_num_rows($userResult) == 1){
        // user exists: 
        $row = mysqli_fetch_assoc($userResult);

        // Check Password:
        if(password_verify($inputPassword, $row['PasswordHash'])){
            // Correct Password

            // Create session.
            $_SESSION['UserID'] = $row['UserID']; // Set the session variable
            $_SESSION['UserType'] = $row['UserType']; // Set the session variable

            // $GLOBALS['userID'] = $row['userID'];
            // $GLOBALS['Name'] = $row['firstName'];
            global $userName;
            $userName = $row['FirstName'];
            // Redirect according to UserType
            $userType = $row['UserType'];

            switch($userType){
                case 'Customer':
                    header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/customer/customerDashboard.php");
                    break;

                case 'Admin':
                    header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/admin/adminDashboard.php");
                    break;

                case 'ProductionStaff':
                    header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodStaffDashboard.php");
                    break;

                case 'SalesStaff':
                    header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/salesStaff/salesStaffDashboard.php");
                    break;

            }

        }
        else{
            // Wrong Password
            header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php?msg=InvalidPassword ");
        }
    }else{

        // User Doesnt exists.
           header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php?msg=InvalidEmail ");
    }
}
?>
