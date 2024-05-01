

<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
  
}

if( $_SESSION['UserType'] != 'SalesStaff'){
    echo "Access Denied";

}
else {
   // GET ORDER FUNCTIONS
    include '../../../backend/db/dbconfig.php';
    include '../../../backend/functions/orders/getOrder.php';
    include '../../../backend/functions/orders/getOrderItems.php';
    include '../../../backend/functions/sales/getSales.php';
  $currentSalesStaffId = $_SESSION['UserID'];
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";
// Dynamics Values
$totalOrderdata = getOrderForSalesDashboard($conn,$currentSalesStaffId);
$ASSIGNED_ORDER = $totalOrderdata['assigned_orders'];
$IN_TRANSIT_ORDERS = $totalOrderdata['in_transit_delivery'];
$DELIVERED_ORDERS= $totalOrderdata['delivered_orders'];


 $salesTotals =  getSalesStaffDashboard($conn, $currentSalesStaffId);
 $TOTAL_SALES = $salesTotals['total_sales'];
  $TOTAL_PROFIT = $salesTotals['total_profit'];
  $TOTAL_REVENUE = $TOTAL_SALES - $TOTAL_PROFIT;

  $requestedOrders = [];
    // Show unveified i.e Pending Order list
    $currentSalesStaffId = $_SESSION['UserID'];


    $pendingOrderSql = "SELECT orders.*, CONCAT(users.FirstName, ' ', users.LastName) AS Name
                      FROM orders
                      JOIN users ON orders.CustomerID = users.UserID
                      WHERE orders.AssignedDeliveryStaffID = '$currentSalesStaffId' AND orders.DeliveryStatus = 'Delivered'
                      ORDER BY orders.OrderID DESC
                      LIMIT 5;
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
                'DeliveryStatus' => $row['DeliveryStatus'],
               
                'DeliveryDate' => $row['DeliveryDate']
            );
            $requestedOrders[] = $order;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sales Staff Dashboard</title>
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
        <link rel="stylesheet" href='../../components/tables/table.css' />

    
    
  </head>
  <body>
  
 <div class="container">
    <?php include '../../components/sidebar/salesStaffSidebar.php'; ?>
    <main>
        <div class="header">
            <h1>Sales Dashboard</h1>
            <!-- <div class="date">
                <input type="date" />
            </div> -->
        </div>
        <div class="card-container">
            <div class="sales-cards">
                <h3>My Sales</h3>
                <div class="sales-row">
                    <div class="cards">
                        <img src="<?php echo $BASE_URL; ?>images/icons/sales.svg" id="total-sales" class="card-logo" alt="">
                        <div class="cards-details">
                            <span class="card-title">Total Sales:</span>
                            <h3><?php echo $TOTAL_SALES ?></h3>
                        </div>
                    </div>
                    <div class="cards">
                        <img src="<?php echo $BASE_URL; ?>images/icons/profit.svg" id="total-profit" class="card-logo" alt="">
                        <div class="cards-details">
                            <span class="card-title">Total Profit:</span>
                            <h3><?php echo $TOTAL_PROFIT ?></h3>
                        </div>
                    </div>
                </div>
                <div class="sales-row">
                    <div class="cards">
                        <img src="<?php echo $BASE_URL; ?>images/icons/delivery.svg" id="total-sales" class="card-logo" alt="">
                        <div class="cards-details">
                            <span class="card-title">Total Revenue:</span>
                            <h3><?php echo $TOTAL_REVENUE ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-overview">
                <h3>My Orders</h3>
                <div class="order-row">
                    <div class="cards">
                        <img src="<?php echo $BASE_URL; ?>images/icons/sales.svg" id="total-sales" class="card-logo" alt="">
                        <div class="cards-details">
                            <span class="card-title">Not Delivered:</span>
                            <h3><?php echo $ASSIGNED_ORDER?></h3>
                        </div>
                    </div>
                    <div class="cards">
                        <img src="<?php echo $BASE_URL; ?>images/icons/profit.svg" id="total-profit" class="card-logo" alt="">
                        <div class="cards-details">
                            <span class="card-title">In Transit:</span>
                            <h3><?php echo $IN_TRANSIT_ORDERS ?></h3>
                        </div>
                    </div>
                </div>
                <div class="order-row">
                    <div class="cards">
                        <img src="<?php echo $BASE_URL; ?>images/icons/delivery.svg" id="total-sales" class="card-logo" alt="">
                        <div class="cards-details">
                            <span class="card-title">Delivered :</span>
                            <h3><?php echo $DELIVERED_ORDERS ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>



         <div class="table-container" style ='background-color: whitesmoke; padding:3px; border-radius:5px;'>

 <h3>My Recent Sales</h3>
   
<table border="1">
      
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <!-- <th>Verification Status</th>
                <th>Production Status</th> -->
                <th>Delivery Status</th>
                <th>Delivery Date</th>
              
            </tr>

      
            <?php
              $counter = 1; 
             foreach ($requestedOrders as $order): ?>
                <tr>
                     <td><?php echo $counter; ?></td>
                    <td><?php echo $order['CustomerName']; ?></td>
                    <td><?php echo $order['OrderDate']; ?></td>
                    <td><?php echo $order['DeliveryStatus']; ?></td>
                    <td><?php echo $order['DeliveryDate']; ?></td>
                </tr>
            <?php 
            $counter++; 
        endforeach; ?>
     
    </table>
 </div>
    </main>






</div>

<?php
}
?>