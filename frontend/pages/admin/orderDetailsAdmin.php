<?php
include '../../../backend/db/dbconfig.php';
include '../../../backend/functions/orders/getOrderItems.php';
session_start();

// Get the order id
$orderId = $_GET['id'];

// Get order details 
$orderItems = getOrderItems($conn, $orderId);
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

// $allOrderDetails = array();
// get customerDetails and deliveryDetails
$allOrderDetailSql = "SELECT orders.*, 
                           CONCAT(users.FirstName, ' ', users.LastName) AS Name,
                           deliveryDetails.phoneNumber,
                           deliveryDetails.deliveryCity,
                           deliveryDetails.deliveryAddress,
                           deliveryDetails.deliveryInstructions
                    FROM orders
                    JOIN users ON orders.CustomerID = users.UserID
                    JOIN deliveryDetails ON orders.OrderID = deliveryDetails.OrderID
                    WHERE orders.OrderID = '$orderId' and orders.VerificationStatus = 'Pending'";
                     


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
    // $allOrderDetails[] = $orderDetails;
    }

}


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
?>

<head>
        <link rel="stylesheet" href='../../components/tables/orderDetailsTable.css' />
        <link rel="stylesheet" href='../../components/popups/popup.css' />
        <style>
            .cancellation-container {
    display: none;
    padding: 20px;
    border: 1px solid #ced4da; /* Light grey border */
    border-radius: 8px;
    background-color: #f8f9fa; /* Light grey background */
}

.cancellation-container form {
    margin-bottom: 20px;
    display:flex;
    flex-direction:column;

}

.cancellation-container label,
.cancellation-container input[type="text"],
.cancellation-container input[type="date"] {
    display: block;
    margin-bottom: 10px;
}

.cancellation-container input[type="date"],
.cancellation-container input[type="text"],
.cancellation-container input[type="submit"],
.cancellation-container button {
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid blue; /* Light grey border */
}
.cancellation-container input[type="date"]{
    padding:15px;
    width:20rem;
}
.cancellation-container input[type="submit"],
.cancellation-container button {
    background-color: #007bff; /* Blue color */
    color: white;
    margin-right: 10px;
    cursor: pointer;
    width:10rem;
}

.cancellation-container button#close {
    background-color: #6c757d; /* Grey color */
    color: white;
    cursor: pointer;
}

#cancel-proceed:hover{
background-color:#0056b3;
}
.cancellation-container button#close:hover{
    background-color: #5a6268;
}
        </style>
</head>
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
    <br>
<?php 
 // according to user Type the verification status button are shown.
 // Admin : verification status button
 // Production Staff
 // Delivery Staff
  $userType = $_SESSION['UserType'];

            switch($userType){
                case 'Admin':
                    ?> 
                    <div>
                        <button id='verify-pop' onclick="verifyPop()">Verify Order</button>
                        <button id='cancel'>Cancel Order</button>
                    </div>
                    <!-- To show the confirmation -->
                    <!-- <div class="modelPopup" id ='verifyPop'>
                            <div class="confirm-verify">
                                <span>Accept the Order and Send it Production</span>
                                <button class = 'popBtn' id='verify'>Yes</button>
                                <button  class = 'popBtn'id ='cancelPopup'>Cancel</button>
                            </div>  
                    </div> -->
                     <!-- <div class="modelPopup" id= 'cancelPop'> -->
                            <div class="cancellation-container" id ='cancel-container'>
                            <form action="" method ='POST'>
                                Today:<input type="date" id ='todayDate' disabled><br>
                                Cancellation Reason: <input type="text" id = 'cancel-reason'><br>
                            <div>
                                <input type="submit" id='cancel-proceed' value='Proceed'>
                                  <button id = 'close'>Cancel</button>
                                </div>
                            </form>

                        </div>
                    <!-- </div> -->
                    
                    
                    <?php
                    break;

                }

            
            
?>
<script>
    // function verifyPop(){
    //     const verifyModal = document.getElementById('verifyPop');
    //     verifyModal.style.display = 'block';
    // }
     const verifyBtn = document.getElementById('verify-pop');
    const orderId = <?php echo $orderId ?>;
    verifyBtn.addEventListener("click", function(){
        const confirmation = confirm("Are you sure you want to verify this order and send it to production?");
        if (confirmation) {
            console.log("Verification confirmed");
            updateOrderStatus(orderId, 'VerificationStatus', 'Verified');

            
          
        }
    });
    // const verifyBtn = document.getElementById('verify');
    // const orderId = <?php// echo $orderId?>;
    // verifyBtn.addEventListener("click", function(){
    //     console.log("verify clicked");
    //     updateOrderStatus(orderId, 'VerificationStatus', 'Verified');
        
    // })

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
                                   var parentWindow = window.parent;
            
                                    // Close the parent iframe by removing it from the DOM
                                    parentWindow.document.getElementById('orderDetailFrame').remove();
                                    parentWindow.location.reload();
                                })
                                .catch(error => {
                                    console.error('There was a problem with the fetch operation:', error);
                                });
                            }
                            

//  Cancel Orders
                            const cancelContainer = document.getElementById('cancel-container')
                            const cancelBtn = document.getElementById('cancel');
                            // const updateBtn = document.getElementById('updateOrder');
                            const closeBtn = document.getElementById('close');
                            const proceedBtn = document.getElementById('cancel-proceed');
                            const cancelConfirm = document.getElementById("cancelPop");
                            const orderDetailContainer = document.getElementById("detail-container");

                            cancelContainer.style.display ='none';
                            // cancelConfirm.style.display = "none";
                             // Get today's date in the format "YYYY-MM-DD"
                            const today = new Date().toISOString().slice(0, 10);
                            console.log(today);

                            // Set the value of the input field to today's date
                            document.getElementById('todayDate').value = today;

                            cancelBtn.addEventListener("click", function(){
                                
                               orderDetailContainer.style.display = 'none';
                                verifyBtn.style.display ='none';
                                cancelBtn.style.display ='none';
                                cancelContainer.style.display ='block';
                              

                            })
                            closeBtn.addEventListener("click",function(){
                                cancelConfirm.style.display ='none';
                                 orderDetailContainer.style.display = 'block';
                           cancelBtn.style.display ='block';
                           verifyBtn.style.display ='block';
                            })
   
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