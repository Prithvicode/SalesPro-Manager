<?php

// Base URL for images
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";

// Links for sidebar
$DASHBOARD = "http://localhost/InventoryAndSalesManagement/frontend/pages/customer/customerDashboard.php";
$PRODUCTION_ORDERS = "http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/productionOrderList.php";
$PRODUCTION_STARTED = " http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodStarted.php";
$PRODUCTION_HISTORY = "http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodHistory.php#";
$LOGOUT= "http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php";

?>

<head>
  <!-- <link rel="stylesheet" href="sidebar.css" /> -->
</head>

    <div class="container">
    <aside class="sidebar">
      <div class="logo">
        <img src="<?php echo $BASE_URL; ?>images/dashboard.svg" alt="Logo" />
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
          <a href="<?php echo $LOGOUT; ?>">
            <img src="<?php echo $BASE_URL; ?>images/logout.svg" alt="" />
            <span>Logout </span>
          </a>
        </li>
      </div>
    </aside>
    <!-- Main section -->
    <main>
      <div class="header">
        <h1>Dashboard</h1>
        <div class="date">
          <input type="date" />
        </div>
      </div>

      <div class="card-container">
        <!-- <h3>Today's Data</h3> -->
        <!-- Sales -->
        <div class="sales-cards">
          <h3>Sales Overview</h3>
          <!-- <div class="sales-activities"> -->
          <!-- sales card row 1 -->
          <div class="sales-row">
            <div class="cards">
              <img
                src="images/icons/sales.svg"
                id="total-sales"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Total Sales:</span>
                <h3>4000</h3>
              </div>
            </div>
            <div class="cards">
              <img
                src="images/icons/profit.svg"
                id="total-profit"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Total Sales:</span>
                <h3>4000</h3>
              </div>
            </div>
          </div>

          <!-- sales card row 1 -->
          <div class="sales-row">
            <div class="cards">
              <img
                src="images/icons/delivery.svg"
                id="total-sales"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Total Sales:</span>
                <h3>4000</h3>
              </div>
            </div>
            <div class="cards">
              <img
                src="images/icons/truck.svg"
                id="total-delivery"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Total Sales:</span>
                <h3>4000</h3>
              </div>
            </div>
          </div>
          <!-- </div> -->
        </div>

        <!-- Orders Overview -->
        <div class="order-overview">
          <h3>Orders-overview</h3>
          <div class="order-row">
            <div class="cards">
              <img
                src="images/icons/sales.svg"
                id="total-sales"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Total Sales:</span>
                <h3>4000</h3>
              </div>
            </div>
            <div class="cards">
              <img
                src="images/icons/profit.svg"
                id="total-profit"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Total Sales:</span>
                <h3>4000</h3>
              </div>
            </div>
          </div>

          <!-- sales card row 1 -->
          <div class="order-row">
            <div class="cards">
              <img
                src="images/icons/delivery.svg"
                id="total-sales"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Pending Orders:</span>
                <h3>4000</h3>
              </div>
            </div>
            <div class="cards">
              <img
                src="images/icons/truck.svg"
                id="total-delivery"
                class="card-logo"
                alt=""
              />
              <div class="cards-details">
                <span class="card-title">Total Sales:</span>
                <h3>4000</h3>
              </div>
            </div>
          </div>
        </div>

        <!-- No of users -->
        <!-- Top sales tables? -->
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Location</th>
            <th>OrderStatus</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Prithvi</td>
            <td>Location- ajavalakhel</td>
            <td>Pending</td>
            <td>
              <a href="#" class="update" onclick="openUpdateModal()">Update</a>
              <a href="#" class="delete" onclick="openDeleteModal()">Delete</a>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Another Customer</td>
            <td>Another Location</td>
            <td>Completed</td>
            <td>
              <a href="#" class="update" onclick="openUpdateModal()">Update</a>
              <a href="#" class="delete" onclick="openDeleteModal()">Delete</a>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Yet Another Customer</td>
            <td>Yet Another Location</td>
            <td>In Progress</td>
            <td>
              <a href="#" class="update" onclick="openUpdateModal()">Update</a>
              <a href="#" class="delete" onclick="openDeleteModal()">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
    </main>
    <!-- Righst section
    <div class="right">
      <h1>right</h1>
    </div> -->
  </div>

