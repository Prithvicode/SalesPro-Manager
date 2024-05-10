<?php

// Base URL for images
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";

// Links for sidebar
$DASHBOARD = "http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodStaffDashboard.php";
$PRODUCTION_ORDERS = "http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/productionOrderList.php";
$PRODUCTION_STARTED = " http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodStarted.php";
$PRODUCTION_HISTORY = "http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodHistory.php#";
$LOGOUT= "http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php";

?>

<head>
  <!-- <link rel="stylesheet" href="sidebar.css" /> -->
</head>

   
    <aside class="sidebar">
      <div class="logo">
        <img src="<?php echo $BASE_URL; ?>images/logo.png" alt="Logo" height="25px" />
        <span class="logo-title"> SalesProManager</span>
      </div>
      <ul class="menu-links">
        <li class="nav-links">
          <a href="<?php echo $DASHBOARD; ?>">
            <img src="<?php echo $BASE_URL; ?>images/dashboard.svg" alt="" />
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-links">
          <a href="<?php echo $PRODUCTION_ORDERS; ?>">
            <img src="<?php echo $BASE_URL; ?>images/inventory.svg" alt="" />
            <span>Production Orders</span>
            <!-- <img src="images/explore.svg" alt="" /> -->
          </a>
        </li>

        <li class="nav-links">
          <a href="<?php echo $PRODUCTION_STARTED; ?>">
            <img src="<?php echo $BASE_URL; ?>images/inventory.svg" alt="" />
            <span>Production Started</span>
            <!-- <img src="images/explore.svg" alt="" /> -->
          </a>
        </li>

          <li class="nav-links">
          <a href="<?php echo $PRODUCTION_HISTORY; ?>">
            <img src="<?php echo $BASE_URL; ?>images/inventory.svg" alt="" />
            <span>Production History</span>
            <!-- <img src="images/explore.svg" alt="" /> -->
          </a>
        </li>
        <!-- Other menu links -->
      </ul>

      <div class="bottom-content">
        <li class="nav-links">
         <a href="#" onclick="confirmLogout(event)">
                    <img src="<?php echo $BASE_URL; ?>images/logout.svg" alt="" />
                    <span>Logout</span>
          </a>
        </li>
      </div>
    </aside>
    
    <!-- Righst section
    <div class="right">
      <h1>right</h1>
    </div> -->
 <script>
  
    function confirmLogout(event) {
            // Prevent the default behavior of the link (i.e., navigating to $LOGOUT)
            event.preventDefault();

            // Show a confirmation dialog
            var confirmLogout = confirm("Are you sure you want to logout?");

            // If the user confirms, navigate to the logout URL
            if (confirmLogout) {
                window.location.href = "<?php echo $LOGOUT; ?>";
            }
        }
 </script>

