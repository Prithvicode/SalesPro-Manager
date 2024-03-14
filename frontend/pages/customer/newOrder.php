
<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if($_SESSION['UserType'] != 'Customer'){

echo "Access Denied";
}
else {
  $BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";

  //  Dynamics Datas
   $customerId = $_SESSION['UserID'];
    // include '../../../backend/functions/orders/getOrder.php';
    // include '../../../backend/functions/orders/getOrderItems.php';

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Order</title>
    <!-- Same style as customerSyle except main content -->
         <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
     <link rel="stylesheet" href='../../components/tables/orderDetailsTable.css' />

    <link rel="stylesheet" href="newOrderStyle.css" />
  </head>
  <body>
    
<div class="container">
<?php
   include '../../components/sidebar/customerSidebar.php'; 
?>
  <main>
    <div class="header">
        <h2>New Order</h2>
        <!-- <div class="date">
          <input type="date" /> -->
        <!-- </div> -->
      </div>
    
        <!-- Your main content goes here -->
        <div class="form-container">
<h3>Order Details:</h3>          <form id="orderForm" 
          method = "POST" 
          action='http://localhost/InventoryAndSalesManagement/backend/functions/orders/createOrder.php'>
         
               <table id= 'form-table'>
            <tr>
              <td><label for="currentDate">Current Date:</label></td>
              <td><input type="text" id="currentDate" name="currentDate" value="" readonly /></td>
            </tr>
            <tr>
              <td><label for="phoneNumber">Phone Number:</label></td>
              <td><input type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" required /></td>
            </tr>
            <tr>
              <td><label for="deliveryCity">Delivery City:</label></td>
              <td>
                <select name="deliveryCity" id="deliveryCity">
                  <option value="Kathmandu">Kathmandu</option>
                  <option value="Lalitpur">Lalitpur</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><label for="deliveryAddress">Delivery Address:</label></td>
              <td><input type="text" id="deliveryAddress" name="deliveryAddress" required /></td>
            </tr>
            <tr>
              <td><label for="deliveryInstructions">Delivery Instructions:</label></td>
              <td><textarea id="deliveryInstructions" name="deliveryInstructions"></textarea></td>
            </tr>
            <tr>
              <td><label for="expectedDate">Expected Date:</label></td>
              <td><input type="date" id="expectedDate" name="expectedDate" required min="<?php echo date('Y-m-d'); ?>" /></td>
            </tr>
          </table>
      <div class="top-items">
      <label for="">Item Details</label>
      <button type="button" id="addProductBtn" style='float:right'>+ Add Product</button><br>
        <table id = productList><thead>
            <th>Product Name</th>          
            <th>Price</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Action</th>
            
        </thead>
  
      
      </table>
    <br>
      
       </div>
            <input type="submit" value="Submit Order" id = 'submitNewOrder' name ='submitOrder'/>
          </form>
        </div>
      </main>
    </div>

    <!-- JavaScript -->
    <script src = "newOrderForm.js"></script>

    
    
    <script>
      customerID = <?php echo $customerId ?>;
      console.log(customerID);
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
    


    // get delivery Details
    const phoneNumber = document.getElementById('phoneNumber').value;
    const deliveryCity= document.getElementById('deliveryCity').value;
    const deliveryAddress= document.getElementById('deliveryAddress').value;
    const  deliveryInstructions= document.getElementById('deliveryInstructions').value;

    // 


    const deliveryDetails = {
    phoneNumber: phoneNumber,
    deliveryCity: deliveryCity,
    deliveryAddress: deliveryAddress,
    deliveryInstructions: deliveryInstructions
};



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

    // console.log("ORder items"+ orderItemDetails);
   
console.log(customerID);
    // Construct the data object to send in the request
    const postData = {
        customerId: customerID,
        currentDate: currentDate,
        expectedDate: expectedDate,
        orderItemDetails: orderItemDetails,
        deliveryDetails : deliveryDetails
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
<?php
}
?>