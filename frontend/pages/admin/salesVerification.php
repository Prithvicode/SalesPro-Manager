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
    // $currentSalesStaffId = $_SESSION['UserID'];


    $pendingOrderSql = "SELECT orders.*, CONCAT(users.FirstName, ' ', users.LastName) AS Name
                    FROM orders
                    JOIN users ON orders.CustomerID = users.UserID
                    Join sales on orders.OrderID = sales.OrderID
                    WHERE  MoneyReceived = 'No'";


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
    <link rel="stylesheet" href='../../components/tables/table.css' />
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />    
    <style>
 

.frame-wrapper{
    /* background-color:aqua; */
    height:90%;
    display:flex;
    /* flex-direction:column; */
    /* top:10; */
    align-items: center;
    justify-content:center;
}

/* #iframeContent {
  width: 500px;
  height: 600px;
} */
</style>
</head>
<body>
<div class="container">
    

<?php
   include '../../components/sidebar/adminSidebar.php'; 
?>


 <?php
//  include '../../components/adminSidebar.php';
?>
<div class ='main'>
    <div class="header">
        <h2>Unverified Sales</h2>
    </div>

    <div class="table-container">


   
<table border="1">
      
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
              
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
                     
                    </iframe>
            </div>
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
           
            iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/admin/updateSales.php?id=${orderId}`;
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