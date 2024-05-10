<?php
session_start(); // Start the session

// If session is set, redirect to respective dashboard
if(isset($_SESSION['UserID'])){
    $userType = $_SESSION['UserType'];
    switch($userType){
        case 'Customer':
            header("Location: http://localhost/InventoryAndSalesManagement/frontend/pages/customer/customerDashboard.php");
            exit();
        case 'Admin':
            header("Location: http://localhost/InventoryAndSalesManagement/frontend/pages/admin/adminDashboard.php");
            exit();
        case 'ProductionStaff':
            header("Location: http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodStaffDashboard.php");
            exit();
        case 'SalesStaff':
            header("Location: http://localhost/InventoryAndSalesManagement/frontend/pages/salesStaff/salesStaffDashboard.php");
            exit();
    }
}

// If not logged in, display login form
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <link rel="stylesheet" href="../components/forms/login.css" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div class="container">
    <div class="form-container">
      <div class="header">SalesPro Manager Login</div>

      <form action="http://localhost/InventoryAndSalesManagement/backend/functions/authentication/login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required /> <br />

        <label for="password">Password:</label>
        <input type="password" name="password" required /> <br />

        <input type="submit" name="login" value="Login" />
      </form>

      <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/registerPage.php">Register</a>

      <?php 
      if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        echo "<script>alert('$msg')</script>";
      }   
      ?>
    </div>
  </div>
</body>
</html>
