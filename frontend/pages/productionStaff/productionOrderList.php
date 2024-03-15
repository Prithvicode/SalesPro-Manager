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

include '../../../backend/db/dbconfig.php';


$requestedOrders = [];
    // Show unveified i.e Pending Order list


    $pendingOrderSql = "SELECT orders.*, CONCAT(users.FirstName, ' ', users.LastName) AS Name
                        FROM orders
                        JOIN users ON orders.CustomerID = users.UserID
                        WHERE orders.VerificationStatus = 'Verified'
                        AND orders.ProductionStatus = 'Not Started';

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
<head>
     <title>Production Orders</title>
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



<main>
    <div class="header">
        <h2>Production Orders</h2>
    </div>

    <div class="table-container">

    
<table border="1">
      
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
               
                <th>Production Status</th>
                <th>Delivery Date</th>
                <th>Order Details</th>
            </tr>
  
      
            <?php foreach ($requestedOrders as $order): ?>
                <tr>
                    <td><?php echo $order['OrderID']; ?></td>
                    <td><?php echo $order['CustomerName']; ?></td>
                    <td><?php echo $order['OrderDate']; ?></td>
                    
                    <td><?php echo $order['ProductionStatus']; ?></td>
                    <td><?php echo $order['DeliveryDate']; ?></td>
                     <td><a href="?id=<?php echo $order['OrderID']?>" class="showOrderDetails">Show details</a></td>
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
           
            iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/orderDetail.php?id=${orderId}&start=no`;
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