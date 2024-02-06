<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Order</title>
    <!-- Same style as customerSyle except main content -->
    <link rel="stylesheet" href="customerStyle.css" /> 
    <link rel="stylesheet" href="newOrderStyle.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="navbar-logo">Place Order</div>
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
            <li class="sidebar-item">
            <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/customer/customerDashboard.php" 
            class="sidebar-link">Dashboard</a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link active">New Order</a>
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
      <main class="order-content">
        <!-- Your main content goes here -->
        <div class="form-container">
          <form id="orderForm">
            <div class="top-items">
             <label for="currentDate">Current Date:</label>
            <input
              type="text"
              id="currentDate"
              name="currentDate"
              value=""
              readonly
            />

            <button type="button" id="addProductBtn">+ Add Product</button>

            </div>
         

            <div id="productList"></div><br>

            <label for="expectedDate">Expected Date:</label>
            <input type="date" id="expectedDate" name="expectedDate" required/>

            <label for="paymentType">Payment Type:</label>
            <select id="paymentType" name="paymentType">
              <option value="online">Online</option>
              <option value="cash">Cash</option>
            </select>
            <br>

            <input type="submit" value="Submit Order" />
          </form>
        </div>
      </main>
    </div>

    <!-- JavaScript -->
    <script src = "newOrderForm.js"></script>
    <script >
        const currentDateInput = document.getElementById("currentDate")
        var currentDate =  new Date().toISOString().slice(0, 10).replace(/-/g, ' / ');
        console.log(currentDate);
        currentDateInput.value =  currentDate;


        // Add button
          const addProductBtn = document.getElementById("addProductBtn");

    </script>
  </body>
</html>
