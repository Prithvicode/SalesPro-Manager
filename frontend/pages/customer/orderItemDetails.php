<?php
include '../../../backend/db/dbconfig.php';
include '../../../backend/functions/orders/getOrderItems.php';
session_start();

// Get the order id
$orderId = $_GET['id'];

// Get order details 
$orderItems = getOrderItems($conn, $orderId);

// get productName from productId
function getProductNameFromID($conn, $prdId){
    $productName = "";
   $sql = "SELECT ProductName FROM products WHERE ProductID = '$prdId'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $productName = $row['ProductName'];
    }
    return $productName;   
}

// Show customer Details:
  $orderDetails = array(   
                'OrderID' => "",
                'CustomerName' => "",
                'OrderDate' =>"" ,
                'VerificationStatus' => "",
                'deliveryCity' => "",
                'deliveryAddress' =>"" ,
                'deliveryInstructions' => "",
                'phoneNumber' => "",
                'DeliveryDate' => ""
    );

 // fetch customer details 
       $allOrderDetailSql = "SELECT orders.*, 
                           CONCAT(users.FirstName, ' ', users.LastName) AS Name,
                           deliveryDetails.phoneNumber,
                           deliveryDetails.deliveryCity,
                           deliveryDetails.deliveryAddress,
                           deliveryDetails.deliveryInstructions
                    FROM orders
                    JOIN users ON orders.CustomerID = users.UserID
                    JOIN deliveryDetails ON orders.OrderID = deliveryDetails.OrderID
                    WHERE orders.OrderID = '$orderId'";

$result = mysqli_query($conn, $allOrderDetailSql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
             $orderDetails = array(   
                'OrderID' => $row['OrderID'],
                'CustomerName' => $row['Name'],
                'OrderDate' => $row['OrderDate'],
                'VerificationStatus' => $row['VerificationStatus'],
                'deliveryCity' => $row['deliveryCity'],
                'deliveryAddress' => $row['deliveryAddress'],
                'deliveryInstructions' => $row['deliveryInstructions'],
                'phoneNumber' => $row['phoneNumber'],
                'DeliveryDate' => $row['DeliveryDate']
    );
                $currentDeliveryStatus = $row['DeliveryStatus'];
            }
         
            // echo "<script> console.log('" . $currentDeliveryStatus ."') </script>" ;
            // echo $currentDeliveryStatus;
        }?>

<head>
        <link rel="stylesheet" href='../../components/tables/orderDetailsTable.css' />
        <link rel="stylesheet" href='../../components/popups/popup.css' />
             <link rel="stylesheet" href='statusStyle.css' />

</head>
<!-- show order and custoemr Details -->

<div id="detail-container">
<h3>Order Details:</h3>

<table id ='form-table' style="border-collapse: collapse;">
  <tr>
        <td><label for="orderID">Order ID:</label></td>
        <td><?php echo $orderDetails['OrderID']?></td>
    </tr>
    <tr>
        <td><label for="customerName">Customer Name:</label></td>
        <td><?php echo $orderDetails['CustomerName']?></td>
    </tr>
    <tr>
        <td><label for="phoneNumber">Phone Number:</label></td>
        <td><?php echo $orderDetails['phoneNumber']?></td>
    </tr>
    <tr>
        <td><label for="deliveryCity">Delivery City:</label></td>
        <td><?php echo $orderDetails['deliveryCity']?></td>
    </tr>
    <tr>
        <td><label for="deliveryAddress">Delivery Address:</label></td>
        <td><?php echo $orderDetails['deliveryAddress']?></td>
    </tr>
    <tr>
        <td><label for="deliveryInstructions">Delivery Instruction:</label></td>
        <td><?php echo $orderDetails['deliveryInstructions']?></td>
    </tr>
    <tr>
        <td><label for="deliveryDate">Delivery Date:</label></td>
        <td><?php echo $orderDetails['DeliveryDate']?></td>
    </tr>
</table>

<br>



<!-- Show the order item details table -->
<table border="1">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
    </tr>
    
    <?php 
    $totalAmount = 0;
    foreach ($orderItems as $item): 
        
    // Get the respective product name from product Id
        $productName = getProductNameFromID($conn, $item['ProductID']);   
        $totalAmount = $totalAmount + $item['Amount'];
    ?> 
        <tr>
            <td><?php echo $productName ?></td>
            <td>Rs.<?php echo $item['Price']; ?></td>
            <td><?php echo $item['Quantity']; ?></td>
            <td>Rs. <?php echo $item['Amount']; ?></td>
            
        </tr>
       
    <?php endforeach; ?>
    <tr>
            <td colspan = 3>Total Amount</td>
            <td>Rs. <?php echo $totalAmount?></td>
        </tr>
</table>
</div>
<?php 
 // according to user Type the verification status button are shown.
 // Admin : verification status button
 // Production Staff
 // Delivery Staff
  $userType = $_SESSION['UserType'];

            switch($userType){
                case 'Customer':
                    // if the order verification Status is pending then
                    if($orderDetails['VerificationStatus'] == 'Pending'){
                        // able to cancel orders
                        ?> <button id="cancel-order">Cancel Order</button>
                        <!-- <button id="updateOrder">Update Order</button> -->
                        <div class="cancellation-container" id ='cancel-container'>
                            <form action="" method ='POST'>
                                Today:<input type="date" id ='todayDate' disabled><br>
                                Cancellation Reason: <input type="text" id = 'cancel-reason' required><br>
                              
                                <input type="submit" id='cancel-proceed' value='Proceed'>
                                  <button id = 'close'>Close</button>
                            </form>

                        </div>

                        <script>
                            const cancelContainer = document.getElementById('cancel-container')
                            const cancelBtn = document.getElementById('cancel-order');
                            //const updateBtn = document.getElementById('updateOrder');
                            const closeBtn = document.getElementById('close');
                            const proceedBtn = document.getElementById('cancel-proceed');

                            const orderDetailContainer = document.getElementById("detail-container");
                            // hidden
                           
                            cancelContainer.style.display ='none';
                            cancelBtn.addEventListener("click", function(){
                                orderDetailContainer.style.display = 'none';
                                cancelBtn.style.display ='none';
                                cancelContainer.style.display ='block';
                            })

                            // updateBtn.addEventListener("click", function(){
                                
                            // })
                            closeBtn.addEventListener("click", function(){
                           cancelContainer.style.display ='none';
                           orderDetailContainer.style.display = 'block';
                           cancelBtn.style.display ='block';

                            })

                            
                            // for date:
                            // Get today's date in the format "YYYY-MM-DD"
                            const today = new Date().toISOString().slice(0, 10);
                            console.log(today);

                            // Set the value of the input field to today's date
                            document.getElementById('todayDate').value = today;

                            // Optional: Display the selected date using JavaScript
                            document.getElementById('todayDate').addEventListener('input', function() {
                            document.getElementById('selectedDate').innerText = 'Selected Date: ' + this.value;
                            });
                                
                        // Proceed Button:
                        proceedBtn.addEventListener("click", function(){
                            const orderID = <?php echo $orderId?>;
                            const cancelDate = document.getElementById('todayDate').value;
                            const cancelReason = document.getElementById('cancel-reason').value;
                            const cancelDetails ={
                                orderID : orderID,
                                cancelDate: cancelDate,
                                reason : cancelReason
                            }
                            console.log(cancelDetails);

                           const url = "http://localhost/InventoryAndSalesManagement/backend/functions/orders/cancelOrder.php"
                              // Options for the fetch request
                                const options = {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json' // Specify content type as JSON
                                    },
                                    body: JSON.stringify(cancelDetails) // Convert JavaScript object to JSON string
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
                        <?php
                        // able to update orders

                    }
                    // if not disable the buttons 
                    // show update order Items
                    
                    break;

                // case 'Admin':
                    ?> 
                    <!-- <div>
                        <button id='verify'>Verify Order</button>
                        <script>
                            const verifyBtn = document.getElementById('verify');
                            verifyBtn.addEventListener("click", 
                            function(){
                                console.log("verified");
                                // <?php
                                // // update the order status to verified 
                                // $verifySql = "UPDATE orders set VerificationStatus = 'Verified' where OrderID = '$orderId'";
                                // $result = mysqli_query($conn, $verifySql);
                                // if($result){
                             ?> 
                                alert("Order Verification Successful.");
                                
                                <?php
                                // }

                                ?>
                            })

                        </script>
                    </div> -->
                    <?php
                    break;

                case 'ProductionStaff':
                    ?>
                    <div>
                        <button id="prodStart">Production Started</button>
                        <button id='prodComplete'>Production Completed</button>
                        <script>
                            const prodCompleteBtn = document.getElementById('prodComplete');
                            const prodStartBtn = document.getElementById('prodStart');
                            const orderId = <?php echo $orderId?>;

                            // according to page disable buttons:
                            const currentUrl = window.location.href;
                            console.log(currentUrl);
                            
                            function updateOrderStatus(orderId, statusType, statusValue) {
                                const url = 'http://localhost/InventoryAndSalesManagement/backend/functions/orders/updateOrder.php';
                                fetch(url, {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        id: orderId,
                                        statusType: statusType,
                                        statusValue: statusValue
                                    })
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok.');
                                    }
                                    return response.text(); // Assuming you expect text response from server
                                })
                                .then(data => {
                                    console.log(data); // Log the response from the server
                                   // alert the message 
                                   alert(data);
                                })
                                .catch(error => {
                                    console.error('There was a problem with the fetch operation:', error);
                                });
                            
}
                            // Prodcution Started button:
                            prodStartBtn.addEventListener("click", 
                            function(){
                                
                                updateOrderStatus(orderId,'ProductionStatus', 'Started');

                            })

                            // Prodcution Completed button:
                            prodCompleteBtn.addEventListener("click", 
                            function(){
                                
                                updateOrderStatus(orderId,'ProductionStatus', 'Completed');

                            })

                        
                            

                        </script>
                    </div>
                    <?php
                    break;

                case 'SalesStaff':
                    break;

            }

 




?>