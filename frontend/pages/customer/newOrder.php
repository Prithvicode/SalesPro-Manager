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
        <div class="logout-button">
          <a href="http://localhost/InventoryAndSalesManagement/backend/functions/authentication/logout.php">
        Logout
          </a></div>
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
            <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/customer/orderStatusPage.php" class="sidebar-link active">New Order</a>
          </li>
          <li class="sidebar-item">
            <a href="http://localhost/InventoryAndSalesManagement/frontend/pages/customer/orderStatusPage.php" class="sidebar-link">My Order Status</a>
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
          <form id="orderForm" 
          method = "POST" 
          action='http://localhost/InventoryAndSalesManagement/backend/functions/orders/createOrder.php'>
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
            </select>   <br>

            <input type="submit" value="Submit Order" id = 'submitNewOrder' name ='submitOrder'/>
          </form>
        </div>
      </main>
    </div>

    <!-- JavaScript -->
    <script src = "newOrderForm.js"></script>
    <script>
      <?php
      session_start();
          // set customerID from session
          echo 'const customerID = ' . json_encode($_SESSION['UserID']) . ';';
          
      ?>
    </script>
    
    <script >
        const currentDateInput = document.getElementById("currentDate")
        // var currentDate = new Date().toISOString().slice(0, 10).replace(/-/g, ' / ');
        var currentDate = new Date().toISOString().slice(0, 10);
        console.log(currentDate);
        currentDateInput.value =  currentDate;
   

        // Add button
          const addProductBtn = document.getElementById("addProductBtn");


      // POST Submit the Order Details.
    document.getElementById('orderForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission

      //check quantity
    

    // Get order details
    const currentDate = document.getElementById('currentDate').value;
    const expectedDate = document.getElementById('expectedDate').value;
    const paymentType = document.getElementById('paymentType').value;


    // Get product items details
    const productItems = document.querySelectorAll(".product-item");
    const orderItemDetails = [];

    productItems.forEach(function (productItem, index) {
        const productID = productItem.querySelector(`#productName`).value;
        const price = productItem.querySelector(`#price`).value;
        const quantity = productItem.querySelector(`#quantity`).value;
        const amount = productItem.querySelector(`#amount`).value;
        

        orderItemDetails.push({
            productId: productID,
            price: price,
            quantity: quantity,
            amount: amount
        });
    });

    console.log("ORder items"+ orderItemDetails);
   
console.log(customerID);
    // Construct the data object to send in the request
    const postData = {
        customerId: customerID,
        currentDate: currentDate,
        expectedDate: expectedDate,
        paymentType: paymentType,
        orderItemDetails: orderItemDetails
    };
console.log("POSt dta: ")
console.log(postData);
    // URL endpoint to send the POST request to
    const url = 'http://localhost/InventoryAndSalesManagement/backend/functions/orders/createOrder.php';

    // Options for the fetch request
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Specify content type as JSON
        },
        body: JSON.stringify(postData) // Convert JavaScript object to JSON string
    };

    // Send the POST request
    fetch(url, options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            console.log('Response:', data);
             alert(data.message); 
            setTimeout(function() { window.location.reload()},500);

        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            // Handle errors
        });
});



    </script>
  </body>
</html>
