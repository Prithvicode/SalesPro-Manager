<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link rel="stylesheet" href="../components/forms/login.css" />
  </head>
  <body>
    <div class="container">
      <div class="form-container">
        <div class="header"></div>

        <form
          action="http://localhost/InventoryAndSalesManagement/backend/functions/authentication/login.php"
          method="POST"
        >
          <label for="email">Email:</label>
          <input type="email" name="email" required /> <br />

          <label for="email">Password:</label>
          <input type="password" name="password" required /> <br />

          <input type="submit" name="login" value="Login" />
        </form>

        <a
          href="http://localhost/InventoryAndSalesManagement/frontend/pages/registerPage.php"
          >Register</a
        >
        <?php 
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo $msg;
}   
?>
      </div>
    </div>
  </body>
</html>
