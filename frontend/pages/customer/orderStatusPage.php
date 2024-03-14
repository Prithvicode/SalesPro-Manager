<?php 
session_start();
if(!isset($_SESSION['UserID'])){
    header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if($_SESSION['UserType'] != 'Customer'){
    echo "Access Denied";
} else {
    // GET ORDER FUNCTIONS
    include '../../../backend/db/dbconfig.php';
    include '../../../backend/functions/orders/getOrder.php';
    include '../../../backend/functions/orders/getOrderItems.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link rel="stylesheet" href='../../components/tables/table.css' />
     <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
     <link rel="stylesheet" href='statusStyle.css' />
  
     
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
 </style>
</head>
<body>
   <div class="container">
<?php
   include '../../components/sidebar/customerSidebar.php'; 
?>

        <!-- Main Content -->
        <main class="main-content" style='width:100%'>
             <div class="header">
        <h2>My Orders</h2>
        
      </div>

            <div class="table-container">
                <table border="1" id="orderTable">
                    <tr>
                        <th>Order Date</th>
                        <th>Order Number</th>
                        <th>Verification Status</th>
                        <th>Production Status</th>
                        <th>Delivery Status</th>
                        <th>Order Details</th>
                    </tr>
                    <?php 
                    $customerId = $_SESSION['UserID'];
                    $customerOrders = getCustomerOrder($conn, $customerId);
                    foreach ($customerOrders as $item): ?>
                        <tr>
                            <?php foreach ($item as $value): ?>
                                <td><?php echo $value; ?></td>
                                
                            <?php endforeach; ?>
                            <td><a href="?id=<?php echo $item[1]?>" class="showOrderDetails">Show details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

                <div id="orderDetailFrame" class = 'modal' style="display: none;">
                   <span id="closeFrame">&times;</span><br>
                    <div class="frame-wrapper">
                    <!-- <button id="closeFrame">Close</button><br> -->

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
           
            iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/customer/orderItemDetails.php?id=${orderId}`;
            iframeContainer.style.display = "block"; // Show iframe container
        });
    });

    closeIframeButton.addEventListener("click", function () {
        iframeContainer.style.display = "none"; // Hide iframe container
        iframeContent.src = ""; // Reset iframe src
        location.reload();
    });
});

    </script>
    <script src = '../../components/tables/table.js'></script>

</body>
</html>

<?php 
}
?>
