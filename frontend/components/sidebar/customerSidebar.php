<?php

// Base URL for images
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";

// Links for sidebar
$DASHBOARD = "http://localhost/InventoryAndSalesManagement/frontend/pages/customer/customerDashboard.php";
$NEWORDERS = "http://localhost/InventoryAndSalesManagement/frontend/pages/customer/newOrder.php";
$ORDERS= "http://localhost/InventoryAndSalesManagement/frontend/pages/customer/orderStatusPage.php";
$LOGOUT= "http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php";

?>
<head>
  <!-- <link rel="stylesheet" href="sidebar.css" /> -->
</head>

  <div class="container">
    <aside class="sidebar">
      <div class="logo">
        <img src="<?php echo $BASE_URL?>images/dashboard.svg" alt="Logo" />
        <span class="logo-title"> SalesProManager</span>
      </div>
      <ul class="menu-links">
        <li class="nav-links">
          <a href="<?php echo $DASHBOARD ?>">
            <img src="<?php echo $BASE_URL?>images/dashboard.svg" alt="" />
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-links">
          <a href="<?php echo $NEWORDERS ?>">
            <img src="<?php echo $BASE_URL?>images/inventory.svg" alt="" />
            <span>New Orders</span>
            <!-- <img src="images/explore.svg" alt="" /> -->
          </a>
        </li>
        <li class="nav-links">

          <a href="<?php echo $ORDERS ?>">
            <img src="<?php echo $BASE_URL?>images/orders.svg" alt="" />
            <span>Orders</span>
            <!-- <img src="images/explore.svg" alt="" /> -->
          </a>
        </li>

     
      </ul>

      <div class="bottom-content">
        <li class="nav-links">
          <a href="<?php echo $LOGOUT ?>">
            <img src="<?php echo $BASE_URL?>images/logout.svg" alt="" />
            <span>Logout </span>
          </a>
        </li>
      </div>
    </aside>
   
    <!-- Righst section
    <div class="right">
      <h1>right</h1>
    </div> -->


