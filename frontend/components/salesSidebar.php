  
     <style>
/* Sidebar styles */
.sidebar {
  background-color:#b35509;
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
  background-color: #621e03;
}

/* Main content styles */
.main-content {
  flex: 1;
  padding: 20px;
  box-sizing: border-box;
}


     </style> 

  
  
  <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">Menu</div>
      <ul class="sidebar-menu">
        <li class="sidebar-item active">
          <a href="#" class="sidebar-link">Dashboard</a>
        </li>
        <li class="sidebar-item">
          <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/salesStaff/assignedOrders.php" class="sidebar-link">Assigned Order List</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">My Sales History</a>
        </li>
      </ul>
    </aside>
