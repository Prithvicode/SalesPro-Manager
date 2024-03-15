<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'SalesStaff'){
    echo "Access Denied";

}
else {
    
include '../../../backend/db/dbconfig.php';
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";
// Dynamics Values
$totalSales = '';

$requestedOrders = [];
    // Show unveified i.e Pending Order list
    $currentSalesStaffId = $_SESSION['UserID'];


    $pendingOrderSql = "SELECT orders.*, CONCAT(users.FirstName, ' ', users.LastName) AS Name
                    FROM orders
                    JOIN users ON orders.CustomerID = users.UserID
                    WHERE orders.AssignedDeliveryStaffID = '$currentSalesStaffId' AND DeliveryStatus != 'Delivered'";


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
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assigned Orders</title>
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
    <link rel="stylesheet" href='../../components/tables/table.css' />
    <!-- <link rel="stylesheet" href='productionStyle.css' /> -->
    
<style>
    .frame-wrapper {
  /* background-color:aqua; */
  height: 90%;
  display: flex;
  /* flex-direction:column; */
  /* top:10; */
  align-items: center;
  justify-content: center;
}

</style>
  </head>
   
 <body>
     
<div class="container">
  <?php
   include '../../components/sidebar/salesStaffSidebar.php'; 
?>
<main>
    <div class="header">
        <h2>My Assigned Orders</h2>
    </div>

    <div class="table-container">

 
<table border="1">
      
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <!-- <th>Verification Status</th> -->
                <!-- <th>Production Status</th> -->
                <th>Delivery Status</th>
                <th>Delivery Date</th>
                <th>Order Details</th>
            </tr>
  
      
            <?php foreach ($requestedOrders as $order): ?>
                <tr>
                    <td><?php echo $order['OrderID']; ?></td>
                    <td><?php echo $order['CustomerName']; ?></td>
                    <td><?php echo $order['OrderDate']; ?></td>
                    <td><?php echo $order['DeliveryStatus']; ?></td>
                    <td><?php echo $order['DeliveryDate']; ?></td>
                     <td><a href="http://localhost/InventoryAndSalesManagement/frontend/pages/salesStaff/salesOrderDetails.php?id=<?php echo $order['OrderID']?>" class="showOrderDetails">Show details</a></td>
                </tr>
            <?php endforeach; ?>
     
    </table>
 </div>
      <div id="orderDetailFrame" class = 'modal' style="display: none;">
                    <!-- Close button for the iframe -->
                     <span id="closeFrame">&times;</span><br>
 <div class="frame-wrapper">
                    <iframe id="iframeContent" class = "modal-content">
                     
 </div>
                    </iframe>
                </div>
            </div>
            </main>
            </div>
<script>
      document.addEventListener("DOMContentLoaded", function () {
    const showOrderDetailsLinks = document.querySelectorAll(".showOrderDetails");
    const iframeContainer = document.getElementById("orderDetailFrame");
    const closeIframeButton = document.getElementById("closeFrame");
    const iframeContent = document.getElementById("iframeContent");

    showOrderDetailsLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default link behavior
            
            // Get the order ID from the link's href attribute
            const orderId = link.getAttribute("href").split("=")[1];
            console.log(orderId);
            
            // Set iframe source dynamically based on the order ID
           
            iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/salesStaff/salesOrderDetails.php?id=${orderId}`;
            iframeContainer.style.display = "block"; // Show iframe container
        });
    });

        closeIframeButton.addEventListener("click", function () {
        iframeContainer.style.display = "none"; // Hide iframe container
        iframeContent.src = "";// Reset iframe src

        location.reload(); 
    });
});

    </script>


<?php
}
?>