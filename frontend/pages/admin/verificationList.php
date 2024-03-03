<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'Admin'){
    echo "Access Denied";

}
else {
    
include '../../../backend/db/dbconfig.php';


$requestedOrders = [];
    // Show unveified i.e Pending Order list


    $pendingOrderSql = "SELECT orders.*, CONCAT(users.FirstName, ' ', users.LastName) AS Name
                    FROM orders
                    JOIN users ON orders.CustomerID = users.UserID
                    where VerificationStatus = 'Pending'";

    $result = mysqli_query($conn, $pendingOrderSql);
    if($result){

        while($row = mysqli_fetch_assoc($result)){
            $order = array(
                'OrderID' => $row['OrderID'],
                'CustomerName' => $row['Name'],
                'OrderDate' => $row['OrderDate'],
                'VerificationStatus' => $row['VerificationStatus'],
            
                'DeliveryDate' => $row['DeliveryDate']
            );
            $requestedOrders[] = $order;
        }
    }
?>
<head>
    <style>
        .hero{
display:flex;
        }
    
    
    .orders-containers {
  /* background-color: blue; */
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: flex-start;
  gap: 5rem;
}
#orderTable {
}

#orderDetailFrame {
  display: flex;
  flex-direction: column;
  /* background-color: blue; */
  width: 400px;
  height: auto;
}

#iframeContent {
  width: 500px;
  height: 600px;
}
</style>
</head>
<?php

 include '../../components/adminNav.php';
 ?>

<div class="hero">


 <?php
 include '../../components/adminSidebar.php';
?>
<div class="orders-containers">
    <div class="table-container">
<table border="1">
      
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Order Date</th>
                <th>Verification Status</th>
                <th>Delivery Date</th>
                <th>Order Details</th>
            </tr>
  
      
            <?php foreach ($requestedOrders as $order): ?>
                <tr>
                    <td><?php echo $order['OrderID']; ?></td>
                    <td><?php echo $order['CustomerName']; ?></td>
                    <td><?php echo $order['OrderDate']; ?></td>
                    <td><?php echo $order['VerificationStatus']; ?></td>
                    <td><?php echo $order['DeliveryDate']; ?></td>
                     <td><a href="?id=<?php echo $order['OrderID']?>" class="showOrderDetails">Show details</a></td>
                </tr>
            <?php endforeach; ?>
     
    </table>
    </div>

     <div id="orderDetailFrame" style="display: none;">
                    <!-- Close button for the iframe -->
                    <button id="closeFrame">Close</button>

                    <iframe id="iframeContent">
                     

                    </iframe>
                </div>
            </div>
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
           
            iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/admin/orderDetailsAdmin.php?id=${orderId}`;
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