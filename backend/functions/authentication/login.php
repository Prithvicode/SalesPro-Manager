<?php
if(isset($_POST['login'])){
    // importing config file
    include("../../db/dbconfig.php");

    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];

    $userQuery = "SELECT * FROM users where email = '$inputEmail'";

    $userResult = mysqli_query($conn, $userQuery);

    if(mysqli_num_rows($userResult) == 1){
        // user exists: 
        $row = mysqli_fetch_assoc($userResult);

        // Check Password:
        if(password_verify($inputPassword, $row['passwordHash'])){
            // Correct Password

            // Create session.
            
            // $GLOBALS['userID'] = $row['userID'];
            // $GLOBALS['Name'] = $row['firstName'];
            global $userName;
            $userName = $row['firstName'];
            // Redirect according to UserType
            $userType = $row['userType'];

            switch($userType){
                case 'Customer':
                    header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/customerDashboard.php");
                    break;

                case 'Admin':
                    header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/adminDashboard.php");
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