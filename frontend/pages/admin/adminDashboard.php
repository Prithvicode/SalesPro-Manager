<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'Admin'){
    echo "Access Denied";

}
else {



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminStyle.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="navbar-logo">Admin Dashboard</div>
      <div class="navbar-icons">
        <div class="notification-icon">🔔</div>
        <div class="logout-button"><a href="http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php">Logout</a></div>
      </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">Menu</div>
      <ul class="sidebar-menu">
        <li class="sidebar-item active">
          <a href="#" class="sidebar-link">Dashboard</a>
        </li>
        <li class="sidebar-item">
          <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/admin/addProduct.php#" class="sidebar-link">Products</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">SalesOrder</a>
          <ul class="submenu">
            <li><a class = "sidebar-link" href="#">Unverified List</a></li>
            <li><a class = "sidebar-link" href="#">Verified List</a></li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Production</a>
          <ul class="submenu">
            <li><a class = "sidebar-link" href="#">Production List</a></li>
            <li><a class = "sidebar-link" href="#" >Unverified Production Orders</a></li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Inventory</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Sales Verification</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Sales History</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Report</a>
        </li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Your main content goes here -->
    </main>

    <!-- JavaScript -->
    <script src="scripts.js"></script>
  </body>
</html>
<?php
}
?>