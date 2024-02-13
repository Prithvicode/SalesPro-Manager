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

            <input type="submit" value="Submit Order" id = 'submitNewOrder' />
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


    
  // POST orderDetails
  document.getElementById('orderForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission


    // To store order Deatails
    const orderDetails = [];
    // To store multiple product details
    const orderItemDetails = [];

    const productItems = document.querySelectorAll(".product-item");
    const formData = new FormData();

    productItems.forEach(function (productItem, index) {
        const productName = productItem.querySelector("#productName").value;
        const price = productItem.querySelector("#price").value;
        const quantity = productItem.querySelector("#quantity").value;
        const amount = productItem.querySelector("#amount").value;

        orderItemDetails.push([productName, price, quantity, amount]);
    });
    console.log( orderItemDetails);
     
    // Get Order Details 



    // Get Order Items Details



    

    // URL endpoint to send the POST request to
    const url = '';

    // // Options for the fetch request
    // const options = {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json' // Specify content type as JSON
    //     },
    //     body: JSON.stringify(postData) // Convert JavaScript object to JSON string
    // };

    // // Send the POST request
    // fetch(url, options)
    //     .then(response => {
    //         if (!response.ok) {
    //             throw new Error('Network response was not ok');
    //         }
    //         return response.json(); // Parse the JSON response
    //     })
    //     .then(data => {
    //         console.log('Response:', data);
    //         // Handle the response data
    //     })
    //     .catch(error => {
    //         console.error('There was a problem with the fetch operation:', error);
    //         // Handle errors
    //     });
});

      


      // POST order Items


    </script>
  </body>
</html>
