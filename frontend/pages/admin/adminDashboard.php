<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'Admin'){
    echo "Access Denied";
}
else {
    // GET ORDER FUNCTIONS
    include '../../../backend/db/dbconfig.php';
    include '../../../backend/functions/orders/getOrder.php';
    include '../../../backend/functions/orders/getOrderItems.php';
    include '../../../backend/functions/sales/getSales.php';

// Base URL for images
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";


$adminDashboardData = getAdminDashboardData($conn); 
// Dynamics Values
$TOTAL_ORDERS = $adminDashboardData['total_orders'];
$PENDING_ORDERS = $adminDashboardData['pending_orders'];
$VERIFIED = $adminDashboardData['verified_orders'];
$CANCELLED = $adminDashboardData['cancelled_orders'];
$INPRODUCTION = $adminDashboardData['started_production'];
$INTRANSIT = $adminDashboardData['in_transit_delivery'];
$TOTAL_DELIVERED = $adminDashboardData['delivered_orders'];


// $TOTAL_CUSTOMERS;
// $TOTAL_SALES_STAFFS;
// $TOTAL_SALES_STAFFS;


   // Call the function to get sales totals
    $salesTotals =  getSalesAdminDashboard($conn);
    $TOTAL_REVENUE = $salesTotals['total_sales'];
    $TOTAL_PROFIT = $salesTotals['total_profit'];
    $TOTAL_SALES = $salesTotals['total_sales_number'];



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
        <link rel="stylesheet" href='../../components/tables/table.css' />
</head>

<body>
<div class="container">
<?php
   include '../../components/sidebar/adminSidebar.php'; 
   
?>
<!-- Main section -->
    <main>
      <div class="header">
        <h1> Admin Dashboard</h1>
        <!-- <div class="date">
          <input type="date" />
        </div> -->
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
                src="<?php echo $BASE_URL; ?>images/icons/total_sales.png"
                id="total-sales"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Sales:</span>
                 <h3><?php echo $TOTAL_SALES; ?></h3>
              </div>
            </div>
            <div class="cards">
              <img
                src="<?php echo $BASE_URL; ?>images/icons/total_profit.png"
                id="total-profit"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Profit:</span>
               <h3><?php echo $TOTAL_PROFIT; ?></h3>
              </div>
            </div>
          </div>

          <!-- sales card row 1 -->
          <div class="sales-row">
            <div class="cards">
              <img
                src="<?php echo $BASE_URL; ?>images/icons/revenue.png"
                id="total-sales"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Revenue:</span>
               <h3><?php echo $TOTAL_REVENUE; ?></h3>
              </div>
            </div>
            <div class="cards">
              <img
                src="<?php echo $BASE_URL; ?>images/icons/deliveryTruck.png"
                id="total-delivery"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Delivered:</span>
                <h3><?php echo $TOTAL_DELIVERED ?></h3>
              </div>
            </div>
          </div>
          <!-- </div> -->
        </div>

         <!-- Orders Overview -->
        <div class="order-overview">
            <h3>Orders Overview</h3>
            <div class="order-row">
                <div class="cards">
                    <img src="<?php echo $BASE_URL; ?>images/icons/total_order.png" class="card-logo" alt="">
                    <div class="cards-details">
                        <span class="card-title">Total Orders:</span>
                        <h3><?php echo $TOTAL_ORDERS; ?></h3>
                    </div>
                </div>
                <div class="cards">
                    <img src="<?php echo $BASE_URL; ?>images/icons/pending.png" class="card-logo" alt="">
                    <div class="cards-details">
                        <span class="card-title">Pending:</span>
                        <h3><?php echo $PENDING_ORDERS; ?></h3>
                    </div>
                </div>
            </div>
            <div class="order-row">
                <div class="cards">
                    <img src="<?php echo $BASE_URL; ?>images/icons/verified_order.png" class="card-logo" alt="">
                    <div class="cards-details">
                        <span class="card-title">Verified :</span>
                        <h3><?php echo $VERIFIED; ?></h3>
                    </div>
                </div>
                <div class="cards">
                    <img src="<?php echo $BASE_URL; ?>images/icons/cancel_order.png" class="card-logo" alt="">
                    <div class="cards-details">
                        <span class="card-title">Cancelled :</span>
                        <h3><?php echo $CANCELLED; ?></h3>
                    </div>
                </div>
            </div>
        </div>
      
      </div>
      <!-- RECENT SALES TABLES -->
  
    
    <div class="table-wrapper" style ='background-color: whitesmoke; padding:3px;'>
      <?php 
  // GET recent sales:
  $recentSales =  getRecentSales($conn);

?>

    <h3 >Recent Sales:</h3>
   <table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Customer Name</th>
          
            <th>Money Received</th>
            <th>Profit Made</th>
            <th>Payment Type</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach ($recentSales as $sale): ?>
        <tr>
            <td><?php echo $index++; ?></td>
            <td><?php echo $sale['CustomerName'] ?></td>
          
     
            <td><?php echo $sale['MoneyReceived']; ?></td>
            <td><?php echo $sale['ProfitMade']; ?></td>
            <td><?php echo $sale['PaymentType']; ?></td>
            <td><?php echo $sale['TotalAmount']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>

          </div>
     
    </main>

  </div>
  </body>
</html>
<?php
}
?>