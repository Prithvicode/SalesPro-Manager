   <!-- Navbar -->
 <style>
    /* Navbar styles */
    *{
      margin:0;
      padding: 0;;
    }
.navbar {
  background-color: #c05904;
  color: white;
  padding: 10px;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.navbar-logo {
  font-size: 1.5em;
}

.navbar-icons {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.notification-icon,
.logout-button {
  cursor: pointer;
}
  
</style>
  
  <!-- Navbar -->
    <nav class="navbar">
      <div class="navbar-logo">Sales Staff Dashboard</div>
      <div class="navbar-icons">
        <div class="notification-icon">🔔</div>
        <div class="logout-button"><a href="http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php">Logout</a></div>
      </div>
    </nav>
