<style>
    /* Reset some default styles */
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

/* Navbar styles */
.navbar {
  background-color: #28a745;
  color: white;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar-logo {
  font-size: 1.5em;
}

.navbar-icons {
  display: flex;
  align-items: center;
}

.notification-icon {
  margin-right: 20px;
  cursor: pointer;
}

.logout-button {
  cursor: pointer;
}

</style>  
  
  
  <!-- Navbar -->
    <nav class="navbar">
      <div class="navbar-logo">Production Staff Dashboard</div>
      <div class="navbar-icons">
        <div class="notification-icon">🔔</div>
        <div class="logout-button">
            <a href="http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php">Logout</a>
        </div>
      </div>
    </nav>