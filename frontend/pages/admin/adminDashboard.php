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
    <link rel="stylesheet" href="../../layouts/adminDashboardStyle.css" />
    
   
  <?php 
   include '../../components/adminNav.php';
   
  
   ?>

   <div class="hero">

<?php
   include '../../components/adminSidebar.php';
?>

  <!-- Main Content -->
    <main class="main-content">
      <div class="summary-row">
        <p >Today's Data</p>
            <div class="card-row">
            <div class="card totalSales">
              <p class ='sum-head'>Total Sales</p>
              <p>Rs. 50000000</p>
              <p>-------------------</p>
            </div>
            <div class="card pendingOrders">
              <p class ='sum-head'>Pending Order</p>
              <p>50</p>
              <p>-------------------</p>
            </div>
            <div class="card deliveredOrders">
              <p class ='sum-head'>Delivered Order</p>
              <p>50</p>
              <p>-------------------</p>
            </div>

            <div class="card deliveredOrders">
              <p class ='sum-head'>Delivered Order</p>
              <p>50</p>
              <p>-------------------</p>
            </div>
            </div>
      </div>


      <div class="summary-row">
        <p >Today's Data</p>
            <div class="card-row">
            <div class="card totalSales">
              <p class ='sum-head'>Total Sales</p>
              <p>Rs. 50000000</p>
              <p>-------------------</p>
            </div>
            <div class="card pendingOrders">
              <p class ='sum-head'>Pending Order</p>
              <p>50</p>
              <p>-------------------</p>
            </div>
            <div class="card deliveredOrders">
              <p class ='sum-head'>Delivered Order</p>
              <p>50</p>
              <p>-------------------</p>
            </div>

            <div class="card deliveredOrders">
              <p class ='sum-head'>Delivered Order</p>
              <p>50</p>
              <p>-------------------</p>
            </div>
            </div>
      </div>




    

      
    </main>
   </div>
   
    
  
    </script>
  </body>
</html>
<?php
}
?>