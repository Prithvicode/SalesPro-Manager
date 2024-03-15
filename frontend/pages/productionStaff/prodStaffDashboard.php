
<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'ProductionStaff'){
    echo "Access Denied";

}
else {
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";

// Dynamics Values
$totalSales = '';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Production Staff Dashboard</title>
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
    
    
    

  </head>
  <body>
  
<div class="container">
  <?php
   include '../../components/sidebar/prodStaffSidebar.php'; 
?>


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
</div>
    <!-- JavaScript -->
    <script src="scripts.js"></script>
  </body>
</html>
<?php
};
?>