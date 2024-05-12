<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if($_SESSION['UserType'] != 'Customer'){

echo "Access Denied";
}
else {
  // GET ORDER FUNCTIONS
    include '../../../backend/db/dbconfig.php';
    include '../../../backend/functions/orders/getOrder.php';
    include '../../../backend/functions/orders/getOrderItems.php';
  $BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";

  
   $customerId = $_SESSION['UserID'];
    // include '../../../backend/functions/orders/getOrder.php';
    // include '../../../backend/functions/orders/getOrderItems.php';

    //  Dynamics Datas:
$customerTotalData = getCustomerDashboardData($conn,$customerId); 
$TOTAL_ORDERS = $customerTotalData['total_orders'];
$PENDING_ORDERS = $customerTotalData['pending_orders'];
$VERIFIED = $customerTotalData['verified_orders'];
$CANCELLED = $customerTotalData['cancelled_orders'];
$INPRODUCTION = $customerTotalData['started_production'];
$INTRANSIT = $customerTotalData['in_transit_delivery'];
$DELIVERED = $customerTotalData['delivered_orders'];


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Dashboard</title>
     <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
     <link rel="stylesheet" href='../../components/tables/orderDetailsTable.css' />
          <link rel="stylesheet" href='statusStyle.css' />

    <!-- <link rel="stylesheet" href="forms/customer-dashboard-styles.css" /> -->
  </head>
  <body>
    <div class="container">
<?php
   include '../../components/sidebar/customerSidebar.php'; 
?>
  <main>
    <div class="header">
        <h1> Dashboard</h1>
         <h3 style ="color: rgb(30, 107, 215);"><?php echo $_SESSION['UserName']?></h3>
        <!-- <div class="date">
          <input type="date" /> -->
        <!-- </div> -->
      </div>
      
    <div class="card-container">
    <div class="sales-cards">
        <h3>Orders Overview</h3>
<!-- sales card row 1 -->
<div class="sales-row">
  <div class="cards">
    <img
      src="<?php echo   $BASE_URL?>/images/icons/total_order.png"
      
      class="card-logo"
      alt=""
    />
    <div class="cards-details">
      <span class="card-title">Total Orders:</span>
      <h3><?php echo $TOTAL_ORDERS; ?></h3>
    </div>
  </div>
  <div class="cards">
    <img
      src="<?php echo   $BASE_URL?>/images/icons/pending.png"
  
      class="card-logo"
      alt=""
    />
    <div class="cards-details">
      <span class="card-title">Pending Orders:</span>
      <h3><?php echo $PENDING_ORDERS; ?></h3>
    </div>
  </div>
</div>

<!-- sales card row 1 -->
<div class="sales-row">
  <div class="cards">
    <img
      src="<?php echo   $BASE_URL?>/images/icons/verified_order.png"

      class="card-logo"
      alt=""
    />
    <div class="cards-details">
      <span class="card-title">Verified:</span>
      <h3><?php echo $VERIFIED; ?></h3>
    </div>
  </div>
  <div class="cards">
    <img
      src="<?php echo   $BASE_URL?>/images/icons/cancel_order.png"
      id="total-delivery"
      class="card-logo"
      alt=""
    />
    <div class="cards-details">
      <span class="card-title">Cancelled:</span>
      <h3><?php echo $CANCELLED; ?></h3>
    </div>
  </div>
</div>
<!-- </div> -->
</div>

<!-- Others -->
<div class="sales-cards">
  <h3>Orders Status</h3>
  <!-- <div class="sales-activities"> -->
  <!-- sales card row 1 -->
  <div class="sales-row">
    <div class="cards">
      <img
        src="<?php echo   $BASE_URL?>/images/icons/in_production.png"
        id="total-sales"
        class="card-logo"
        alt=""
      />
      <div class="cards-details">
        <span class="card-title">In Production:</span>
        <h3><?php echo $INPRODUCTION; ?></h3>
      </div>
    </div>
    <div class="cards">
      <img
        src="<?php echo   $BASE_URL?>/images/icons/in_transit.png"
        id="total-profit"
        class="card-logo"
        alt=""
      />
      <div></div>
      <div class="cards-details">
        <span class="card-title">In Transit:</span>
        <h3><?php echo $INTRANSIT; ?></h3>
      </div>
    </div>
  </div>

  <!-- sales card row 1 -->
  <div class="sales-row">
    <div class="cards">
      <img
        src="<?php echo   $BASE_URL?>/images/icons/deliveryTruck.png"
        id="total-sales"
        class="card-logo"
        alt=""
      />
      <div class="cards-details">
        <span class="card-title">Delivered:</span>
        <h3><?php echo $DELIVERED; ?></h3>
      </div>
    </div>
  </div>
</div>
    </div>

    <!-- RECENT ORDERS TABLES -->
  
    <div class="table-wrapper">

    <h3 style='color:rgb(30, 107, 215)'>Recent Orders:</h3>
    <table border =1 >
      
      <thead>
                   
                        <th>Order Date</th>
                        <th>Order Number</th>
                        <th>Verification Status</th>
                        <th>Production Status</th>
                        <th>Delivery Status</th>
                       
      </thead>  
      <?php 
     $customerOrders = getCustomerOrder($conn, $customerId);

        // Get the first 5 items from the $customerOrders array
        $customerOrdersLimited = array_slice($customerOrders, 0, 4);

        foreach ($customerOrdersLimited as $item): ?>
            <tr>
                <?php foreach ($item as $value): ?>
                    <td><?php echo $value; ?></td>
                <?php endforeach; ?>
               
            </tr>
        <?php endforeach; ?>


      
    
    
    </table>

     <div id="orderDetailFrame" style="display: none;">
                    <!-- Close button for the iframe -->
                    <button id="closeFrame">Close</button>

                    <iframe id="iframeContent">
                     

                     </iframe>
    </div>
  </div>
  </main>

</div>
  </body>
</html>
<?php 
}
?>