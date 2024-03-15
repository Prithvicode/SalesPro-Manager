

<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'SalesStaff'){
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
    <title>Sales Staff Dashboard</title>
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
    
    
  </head>
  <body>
  
<div class="container">
  <?php
   include '../../components/sidebar/salesStaffSidebar.php'; 
?>
 <!-- Main section -->
  <main>
    <div class="header">
      <h1>Dashboard</h1>
      <div class="date">
        <input type="date" />
      </div>
    </div>

    <div class="card-container">
      <!-- <h3>Today's Data</h3> -->
      <!-- Sales -->
      <div class="sales-cards">
        <h3>Sales Overview</h3>
        <!-- <div class="sales-activities"> -->
        <!-- sales card row 1 -->
        <div class="sales-row">
          <div class="cards">
            <img
              src="<?php echo $BASE_URL; ?>images/icons/sales.svg"
              id="total-sales"
              class="card-logo"
              alt=""
            />
            <div class="cards-details">
              <span class="card-title">Total Sales:</span>
              <h3>4000</h3>
            </div>
          </div>
          <div class="cards">
            <img
              src="<?php echo $BASE_URL; ?>images/icons/profit.svg"
              id="total-profit"
              class="card-logo"
              alt=""
            />
            <div class="cards-details">
              <span class="card-title">Total Sales:</span>
              <h3>4000</h3>
            </div>
          </div>
        </div>

        <!-- sales card row 1 -->
        <div class="sales-row">
          <div class="cards">
            <img
              src="<?php echo $BASE_URL; ?><?php echo $BASE_URL; ?>images/icons/delivery.svg"
              id="total-sales"
              class="card-logo"
              alt=""
            />
            <div class="cards-details">
              <span class="card-title">Total Sales:</span>
              <h3>4000</h3>
            </div>
          </div>
          <div class="cards">
            <img
              src="<?php echo $BASE_URL; ?>images/icons/truck.svg"
              id="total-delivery"
              class="card-logo"
              alt=""
            />
            <div class="cards-details">
              <span class="card-title">Total Sales:</span>
              <h3>4000</h3>
            </div>
          </div>
        </div>
        <!-- </div> -->
      </div>

      <!-- Orders Overview -->
      <div class="order-overview">
        <h3>Orders-overview</h3>
        <div class="order-row">
          <div class="cards">
            <img
              src="<?php echo $BASE_URL; ?><?php echo $BASE_URL; ?>images/icons/sales.svg"
              id="total-sales"
              class="card-logo"
              alt=""
            />
            <div class="cards-details">
              <span class="card-title">Total Sales:</span>
              <h3>4000</h3>
            </div>
          </div>
          <div class="cards">
            <img
              src="<?php echo $BASE_URL; ?><?php echo $BASE_URL; ?>images/icons/profit.svg"
              id="total-profit"
              class="card-logo"
              alt=""
            />
            <div class="cards-details">
              <span class="card-title">Total Sales:</span>
              <h3>4000</h3>
            </div>
          </div>
        </div>

        <!-- sales card row 1 -->
        <div class="order-row">
          <div class="cards">
            <img
              src="<?php echo $BASE_URL; ?>images/icons/delivery.svg"
              id="total-sales"
              class="card-logo"
              alt=""
            />
            <div class="cards-details">
              <span class="card-title">Pending Orders:</span>
              <h3>4000</h3>
            </div>
          </div>
          <div class="cards">
            <img
              src="<?php echo $BASE_URL; ?>images/icons/truck.svg"
              id="total-delivery"
              class="card-logo"
              alt=""
            />
            <div class="cards-details">
              <span class="card-title">Total Sales:</span>
              <h3>4000</h3>
            </div>
          </div>
        </div>
      </div>

      <!-- No of users -->
      <!-- Top sales tables? -->
    </div>
  </main>

</div>
<?php
}
?>