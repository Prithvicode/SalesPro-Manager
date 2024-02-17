<style>
    
/* Sidebar styles */
.sidebar {
  background-color: #218838;
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
  background-color: #28a745;
}


</style>


<!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">Menu</div>
      <ul class="sidebar-menu">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Dashboard</a>
        </li>
        <li class="sidebar-item">
          <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/productionOrderList.php" class="sidebar-link">Production Order List</a>
        </li>
        <li class="sidebar-item">
          <a href=" http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodStarted.php" 
          class="sidebar-link">Production Started List</a>
        </li>
        <li class="sidebar-item">
          <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/productionStaff/prodHistory.php#" 
          class="sidebar-link">Production History</a>
        </li>
      </ul>
    </aside>
   