<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="customerStyle.css" />
    <link rel="stylesheet" href="forms/customer-dashboard-styles.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="navbar-logo">Customer Dashboard</div>
      <div class="navbar-icons">
        <div class="notification-icon">🔔</div>
        <div class="logout-button">Logout</div>
      </div>
    </nav>

    <div class="hero">
      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="sidebar-header">Menu</div>
        <ul class="sidebar-menu">
            <li class="sidebar-item active">
            <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/customer/customerDashboard.php" 
            class="sidebar-link">Dashboard</a>
          </li>
          <li class="sidebar-item">
            <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/customer/newOrder.php" 
            class="sidebar-link" id='newOrder'
              >New Order</a
            >
          </li>
          <li class="sidebar-item">
            <a href="" class="sidebar-link">My Order Status</a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link">Profile</a>
          </li>
        </ul>
      </aside>

      <!-- Main Content -->
      <main class="main-content">
 
      </main>
    </div>
   
  </body>
</html>
