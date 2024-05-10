
<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'ProductionStaff'){
    echo "Access Denied";

}
else {
  // GET ORDER FUNCTIONS
    include '../../../backend/db/dbconfig.php';
    include '../../../backend/functions/orders/getOrder.php';
    include '../../../backend/functions/orders/getOrderItems.php';
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";


 $productionStaffId = $_SESSION['UserID'];
 $date = date("Y-m-d");
// Dynamics Values
$productionData  = getProductionDashboardData($conn);
$PRODUCTION_TOTAL_ORDERS = $productionData['verified_orders'] ;

$PRODUCTION_NOT_STARTED =$productionData['not_started_production'] ;
$PRODUCTION_STARTEDS = $productionData['started_production'];
$PRODUCTION_COMPLETED = $productionData['completed_production'];

$productionDataToday  = getProductionDashboardDataFromDate($conn,$date);
$PRODUCTION_TOTAL_ORDERS_TODAY = $productionDataToday['verified_orders'] ;
$PRODUCTION_NOT_STARTED_TODAY =$productionDataToday['not_started_production'] ;
$PRODUCTION_STARTEDS_TODAY = $productionDataToday['started_production'];
$PRODUCTION_COMPLETED_TODAY = $productionDataToday['completed_production'];


// $TOP_PRODUCTION;
// $LEAST_PRODUCTION;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Production Staff Dashboard</title>
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
   <link rel="stylesheet" href='../../components/tables/table.css' />
    <link rel="stylesheet" href='productionStyle.css' />
    
    <style>

    </style>
   

  </head>
  <body>
  
<div class="container">
  <?php
   include '../../components/sidebar/prodStaffSidebar.php'; 
?>


    <!-- Main section -->
    <main>
      <div class="header">
        <h1>Production Dashboard</h1>
        <!-- <div class="date">
          <input type="date" />
        </div> -->
      </div>

      <div class="card-container">
        <!-- <h3>Today's Data</h3> -->
        <!-- Sales -->
        <div class="sales-cards">
          <h3>Production Overview</h3>
          <!-- <div class="sales-activities"> -->
         <!-- sales card row 1 -->
<div class="sales-row">
   <div class="cards">
    <img
      src="<?php echo   $BASE_URL?>/images/icons/total_order.png"
      id="total-sales"
      class="card-logo"
      alt=""
    />
    <div class="cards-details">
      <span class="card-title">Total Order:</span>
      <h3><?php echo $PRODUCTION_TOTAL_ORDERS; ?></h3>
    </div>
  </div>
  <div class="cards">
    <img
      src="<?php echo   $BASE_URL?>/images/icons/not_started.png"
      id="total-sales"
      class="card-logo"
      alt=""
    />
    <div class="cards-details">
      <span class="card-title">Not Started:</span>
      <h3><?php echo $PRODUCTION_NOT_STARTED; ?></h3>
    </div>
  </div>
  
</div>

<!-- sales card row 1 -->
<div class="sales-row">
  <div class="cards">
    <img
      src="<?php echo   $BASE_URL?>/images/icons/started.png"
      id="total-profit"
      class="card-logo"
      alt=""
    />
    <div class="cards-details">
      <span class="card-title">Started:</span>
      <h3><?php echo $PRODUCTION_STARTEDS; ?></h3>
    </div>
  </div>
  <div class="cards">
    <img
      src="<?php echo   $BASE_URL?>/images/icons/completed.png"
      id="total-sales"
      class="card-logo"
      alt=""
    />
    <div class="cards-details">
      <span class="card-title">Completed:</span>
      <h3><?php echo $PRODUCTION_COMPLETED; ?></h3>
    </div>
  </div>
  
</div>
</div>
        <!-- Orders Overview -->
        <div class="order-overview">
          <h3>Todays Overview</h3>
          <div class="order-row">
            <div class="cards">
              <img
                src="<?php echo   $BASE_URL?>/images/icons/total_order.png"
                id="total-sales"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Total Orders:</span>
                <h3><?php echo $PRODUCTION_TOTAL_ORDERS_TODAY?></h3>
              </div>
            </div>
            <div class="cards">
              <img
                src="<?php echo   $BASE_URL?>/images/icons/not_started.png"
                id="total-profit"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Not Started:</span>
                <h3><?php echo $PRODUCTION_NOT_STARTED_TODAY?></h3>
              </div>
            </div>
          </div>

          <!-- sales card row 1 -->
          <div class="order-row">
            <div class="cards">
              <img
                src="<?php echo   $BASE_URL?>/images/icons/started.png"
                id="total-sales"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Started:</span>
                <h3><?php echo $PRODUCTION_STARTEDS_TODAY?></h3>
              </div>
            </div>
            <div class="cards">
              <img
                src="<?php echo   $BASE_URL?>/images/icons/completed.png"
      id="total-sales"
                id="total-delivery"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Completed:</span>
                <h3><?php echo $PRODUCTION_COMPLETED_TODAY?></h3>
              </div>
            </div>
          </div>
        </div>

        <!-- No of users -->
        <!-- Top sales tables? -->
      </div>

      <?php
$requestedOrders = [];
    // Show unveified i.e Pending Order list


    $pendingOrderSql = "SELECT orders.*, CONCAT(users.FirstName, ' ', users.LastName) AS Name
                        FROM orders
                        JOIN users ON orders.CustomerID = users.UserID
                        WHERE orders.VerificationStatus = 'Verified'
                        AND orders.ProductionStatus = 'Completed'
                        ORDER BY orders.OrderID DESC limit 5;

                        ";

    $result = mysqli_query($conn, $pendingOrderSql);
    if($result){

        while($row = mysqli_fetch_assoc($result)){
            $order = array(
                'OrderID' => $row['OrderID'],
                'CustomerName' => $row['Name'],
                'OrderDate' => $row['OrderDate'],
                'VerificationStatus' => $row['VerificationStatus'],
                'ProductionStatus' => $row['ProductionStatus'],
            
                'DeliveryDate' => $row['DeliveryDate']
            );
            $requestedOrders[] = $order;
        }
    }
      ?>

        <div class="table-wrapper" style ='background-color: whitesmoke; padding:3px; border-radius:5px;'>

    <h3 >Recent Production:</h3>
    <table border =1 >
<thead>
  <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Production Status</th>
                <th>Delivery Date</th>
                <!-- <th>Order Details</th> -->
</thead>
<?php 
             $counter = 1; 
            foreach ($requestedOrders as $order): ?>
                <tr>
 <td><?php echo $counter; ?></td>                    <td><?php echo $order['CustomerName']; ?></td>
                    <td><?php echo $order['OrderDate']; ?></td>
                    <td><?php echo $order['ProductionStatus']; ?></td>
                    <td><?php echo $order['DeliveryDate']; ?></td>
                     <!-- <td><a href="?id=<?php echo $order['OrderID']?>" class="showOrderDetails">Show details</a></td> -->
                </tr>
            <?php 
            $counter++; endforeach; ?>

     </table>
  </div>
    </main>
</div>
    <!-- JavaScript -->
    <script src="scripts.js"></script>
  </body>
</html>
<?php
};
?>