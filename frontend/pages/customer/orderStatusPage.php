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
    <link rel="stylesheet" href="statusStyle.css" />
    <link rel="stylesheet" href="customerStyle.css" />
 
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-logo">Order Status</div>
        <div class="navbar-icons">
            <div class="notification-icon">🔔</div>
            <div class="logout-button">
                <a href="http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="hero">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">Menu</div>
            <ul class="sidebar-menu">
                <li class="sidebar-item ">
                    <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/customer/customerDashboard.php" 
                    class="sidebar-link">Dashboard</a>
                </li>
                <li class="sidebar-item">
                    <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/customer/newOrder.php" 
                    class="sidebar-link" id='newOrder'>New Order</a>
                </li>
                <li class="sidebar-item active">
                    <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/customer/orderStatusPage.php" class="sidebar-link">My Order Status</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Profile</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h1>MY Orders</h1>

            <div class="orders-containers">
                <table border="1" id="orderTable">
                    <tr>
                        <th>Order Date</th>
                        <th>Order Number</th>
                        <th>Order Status</th>
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

                <div id="orderDetailFrame" style="display: none;">
                    <!-- Close button for the iframe -->
                    <button id="closeFrame">Close</button>

                    <iframe id="iframeContent">
                     

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
           
            iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/customer/orderItemDetails.php?id=${orderId}`;
            iframeContainer.style.display = "block"; // Show iframe container
        });
    });

    closeIframeButton.addEventListener("click", function () {
        iframeContainer.style.display = "none"; // Hide iframe container
        iframeContent.src = ""; // Reset iframe src
    });
});

    </script>

</body>
</html>

<?php 
}
?>
