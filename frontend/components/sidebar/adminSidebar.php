<?php

// Base URL for images
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";
// Links for sidebar
$DASHBOARD = "http://localhost/InventoryAndSalesManagement/frontend/pages/admin/adminDashboard.php";
$UNVERIFIED_ORDERS = "http://localhost/InventoryAndSalesManagement/frontend/pages/admin/verificationList.php";
$VERIFIED_ORDERS = "verified_orders.php";
$CUSTOMERS = "customers.php";
$PRODUCTS = "http://localhost/InventoryAndSalesManagement/frontend/pages/admin/addProduct.php#";
$PRODUCTION_ORDERS = "http://localhost/InventoryAndSalesManagement/frontend/pages/admin/unverifiedProd.php";
$PRODUCTION_HISTORY = "http://localhost/InventoryAndSalesManagement/frontend/pages/admin/productionHistory.php";
$UNVERIFIED_SALES = "http://localhost/InventoryAndSalesManagement/frontend/pages/admin/salesVerification.php";
$SALES_HISTORY = "http://localhost/InventoryAndSalesManagement/frontend/pages/admin/salesHistory.php";
$STAFFS = "http://localhost/InventoryAndSalesManagement/frontend/pages/admin/staffManagePage.php";
$LOGOUT= "http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php";
$REPORT ="http://localhost/InventoryAndSalesManagement/frontend/pages/admin/reportGeneration.php"
?>


<head>

  <!-- <link rel="stylesheet" href="sidebar.css" /> -->
  <!-- <link rel="stylesheet" href="main.css" /> -->
  <style>
    /* Add your styles here if needed */
    .hidden {
      display: none;
    }
  </style>
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
          <a href="<?php echo $PRODUCTS; ?>">
            <img src="<?php echo $BASE_URL; ?>images/productNav.svg" height=26px width=26px alt="" />
            <span>Products</span>
          </a>
        </li>
        <li class="nav-links" id="orders-link">
          <a href="javascript:void(0);" id ='explore' onclick="toggleSubmenu('order-items')">
          <img src="<?php echo $BASE_URL; ?>images/orders.svg" alt="" />
            <span>Orders</span>
            <img src="<?php echo $BASE_URL; ?>images/explore.svg" class ='explore' alt="" />
          </a>
        </li>
         <!-- Unverified orders -->
          <ul class="hidden" id="order-items">
            <li><a href="<?php echo $UNVERIFIED_ORDERS; ?>">Unverified</a></li>
            <!-- <li><a href="<?php echo $VERIFIED_ORDERS; ?>">Verified</a></li> -->
            <!-- Add more menu items as needed -->
          </ul>
        <li class="nav-links">
          <a href="javascript:void(0);" onclick="toggleSubmenu('production-items')">   
            <img src="<?php echo $BASE_URL; ?>images/inventory.svg" alt="" />
            <span>Production</span>
           
            <img src="<?php echo $BASE_URL; ?>images/explore.svg" alt="" />
          </a>
        </li>
          <!-- Unverified Production -->
          <ul class="hidden" id="production-items">
            <li><a href="<?php echo $PRODUCTION_ORDERS; ?>">Unverified</a></li>
            
            <li><a href="<?php echo $PRODUCTION_HISTORY; ?>">History</a></li>
            <!-- Add more menu items as needed -->
          </ul>
        <li class="nav-links">
          <a href="javascript:void(0);" onclick="toggleSubmenu('sales-items')">
            <img src="<?php echo $BASE_URL; ?>images/salesIcon.svg" alt="" />
            <span>Sales</span>

            <img src="<?php echo $BASE_URL; ?>images/explore.svg" style="margin-left:2.7rem"alt="" />
          </a>
        </li>
        <ul class="hidden" id="sales-items">
            <li><a href="<?php echo $UNVERIFIED_SALES; ?>">Unverified</a></li>
            <li><a href="<?php echo $SALES_HISTORY; ?>">Sales History</a></li>
            
          </ul>
        <li class="nav-links">
          <a href="<?php echo $STAFFS; ?>">
            <img src="<?php echo $BASE_URL; ?>images/staff.svg" alt="" />
            <span>Staff</span>
            
          </a>
        </li>
        <!-- <li class="nav-links">
          <a href="<?php echo $CUSTOMERS; ?>">
            <img src="<?php echo $BASE_URL; ?>images/customer.svg" alt="" />
            <span>Customer</span>
          </a>
        </li> -->
        <li class="nav-links">
          <a href="<?php echo $REPORT; ?>">
            <img src="<?php echo $BASE_URL; ?>images/report.svg" alt="" />
            <span>Report</span>
          </a>
        </li>
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


  <script>
    function toggleSubmenu(submenuId) {
      var submenu = document.getElementById(submenuId);
      if (submenu.style.display === "none" || submenu.style.display === "") {
        submenu.style.display = "block";
      } else {
        submenu.style.display = "none";
      }
    }

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


