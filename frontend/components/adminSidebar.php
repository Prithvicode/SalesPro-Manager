<head>
    <style>
        body,
h1,
h2,
h3,
p,
ul,
li {
  margin: 0;
  padding: 0;
}

/* Body styles */
body {
  font-family: "Arial", sans-serif;
  background-color: #f4f4f4;
  /* display: flex; */
  min-height: 100vh;
}



/* Sidebar styles */
.sidebar {
  background-color: #222;
  color: white;
  width: 200px;
  min-height: 100%;
  height: 100vh;
  padding: 20px;
  box-sizing: border-box;
}

.sidebar-header {
  font-size: 1.2em;
  margin-bottom: 10px;
}

.sidebar-menu {
  list-style-type: none;
  padding: 0;
}

.sidebar-item {
  margin-bottom: 10px;
}

.sidebar-link {
  color: white;
  text-decoration: none;
  display: block;
  padding: 5px;
  border-radius: 5px;
  transition: 0.3s ease;
}

.sidebar-link:hover {
  background-color: #555;
}

.submenu {
  list-style-type: none;
  padding-left: 20px;
}


    </style>
</head>


<body>
   
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">Menu</div>
      <ul class="sidebar-menu">
        <li class="sidebar-item active">
          <a href="#" class="sidebar-link">Dashboard</a>
        </li>
        <li class="sidebar-item">
          <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/admin/addProduct.php#" class="sidebar-link">Products</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">SalesOrder</a>
          <ul class="submenu">
            <li><a class = "sidebar-link" href="http://localhost/InventoryAndSalesManagement/frontend/pages/admin/verificationList.php">Unverified List</a></li>
            <li><a class = "sidebar-link" href="#">Verified List</a></li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Production</a>
          <ul class="submenu">
            <li><a class = "sidebar-link" href="#">Production List</a></li>
            <li><a class = "sidebar-link" href="http://localhost/InventoryAndSalesManagement/frontend/pages/admin/unverifiedProd.php" >Unverified Production Orders</a></li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Inventory</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Sales Verification</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Sales History</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Report</a>
        </li>
      </ul>
    </aside>

