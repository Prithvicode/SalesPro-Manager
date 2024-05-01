<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <link rel="stylesheet" href="../components/forms/register.css" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<div class="container">
    <div class="form-container">
        <div class="header">SalesPro Manager Register</div>
        <form action="http://localhost/InventoryAndSalesManagement/backend/functions/authentication/register.php" method="POST">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>
            <br>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="phoneNo">Phone No:</label>
            <input type="tel" id="phoneNo" name="phoneNo" pattern="[0-9]{10}" required>
            <br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <br>
            <?php 
            if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo "<script>alert('$msg')</script>";
            }
            ?>
            <input type="submit" value="Register" name="register">
            <div class="login-link">
                <span>Already have an account?</span>
                <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php">Log in</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
