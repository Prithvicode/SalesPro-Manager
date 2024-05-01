<?php
// user registration
if(isset($_POST['register'])){
    // database connection
    include_once("../../db/dbconfig.php");

    // user input
    $inputFname = $_POST['firstName'];
    $inputLname = $_POST['lastName'];
   
    $inputEmail = $_POST['email'];
    $inputPhoneno= $_POST['phoneNo'];

    $inputAddress= $_POST['address'];

    $inputPassword = $_POST['password'];
    $inputConfirmPass = $_POST['confirmPassword'];

    // $inputUserType = $_POST['usertype'];
    // Change if Staffs
    $inputUserType = "Customer";


    // check if email already exists?
    $emailQuery = "Select * from users where email = '$inputEmail'";
    $emailResult = mysqli_query($conn, $emailQuery);

    if(mysqli_num_rows($emailResult) > 0){
        // Email already exists.
        header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/registerPage.php?msg=Use Already Exists. Try new email.");
    }
    else{
        if($inputPassword == $inputConfirmPass){
            // Hashing the password:
                $hash_pass = password_hash($inputPassword,PASSWORD_DEFAULT);
                    // Insert into user table.
                $insertUserquery = "insert into users(FirstName, LastName, Email, PasswordHash,UserType,PhoneNumber, Address) 
                                    values(
                                        '$inputFname',
                                        '$inputLname ',
                                        '$inputEmail',
                                        '$hash_pass',
                                        '$inputUserType',
                                        '$inputPhoneno',
                                        '$inputAddress')";
                $resultInsert = mysqli_query($conn, $insertUserquery);

                if($resultInsert){
                    header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php?msg=User Created Successfully");
                }
        }
        else{
            header("Location:http://localhost/InventoryAndSalesManagement/frontend/pages/registerPage.php?msg=Password and Confirm Password Doesnt Match");

        }
    }
  
}