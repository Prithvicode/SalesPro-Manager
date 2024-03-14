

<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'ProductionStaff'){
    echo "Access Denied";

}
else {
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";

// Dynamics Values
$totalSales = '';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Production Staff Dashboard</title>
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />

  </head>
  <body>
  

  <?php
   include '../../components/sidebar/prodStaffSidebar.php'; 
?>


    <!-- Main Content -->
    <main class="main-content">
      <!-- Your main content goes here -->
    </main>

    <!-- JavaScript -->
    <script src="scripts.js"></script>
  </body>
</html>
<?php
};
?>