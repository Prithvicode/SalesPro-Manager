<?php
include '../../../backend/db/dbconfig.php';
include '../../../backend/functions/orders/getOrderItems.php';
session_start();

// Get the order id
$orderId = $_GET['id'];
$prodStart =$_GET['start'];


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
<style>
    #prodStart {
    background-color: #007bff; /* Blue color */
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

#prodStart:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

#prodComplete {
    background-color: #ffc107; /* Yellow color */
    color: black;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

#prodComplete:hover {
    background-color: #d39e00; /* Darker yellow on hover */
}

</style>
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
                
                case 'ProductionStaff':
                    ?>
                    <br>
                    <div>

                        <button id="prodStart" style ='display: none'>Production Started</button>
                        <button id='prodComplete' style ='display: none'>Production Completed</button>
                        <script>
                            const prodCompleteBtn = document.getElementById('prodComplete');
                            const prodStartBtn = document.getElementById('prodStart');
                           const prodStatus = '<?php echo $prodStart; ?>';

                                if (prodStatus === 'no') {
                                    prodStartBtn.style.display = 'block';
                                    prodCompleteBtn.style.display = 'none';
                                } else if(prodStatus == 'yes'){
                                    prodStartBtn.style.display = 'none';
                                    prodCompleteBtn.style.display = 'block';
                                }else{
                                     prodStartBtn.style.display = 'block';
                                    // prodCompleteBtn.style.display = 'block';
                                }

                            const orderId = <?php echo $orderId?>;
                            console.log(orderId)

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
                                     var parentWindow = window.parent;
            
                                    // Close the parent iframe by removing it from the DOM
                                    parentWindow.document.getElementById('orderDetailFrame').remove();
                                    parentWindow.location.reload();
                                //    document.getElementById('detail-container').style.display = 'none';
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
                    prodCompleteBtn.addEventListener("click", function() {
                        updateOrderStatus(orderId, 'ProductionStatus', 'Completed');
                        // Add production log for each product
                        addProductionLog(orderId);
                        // Reload the current URL
                        window.location.reload();

                    });

                    function addProductionLog(orderId) {
                        const url = 'http://localhost/InventoryAndSalesManagement/backend/functions/production/addProductionLog.php';
                        fetch(url, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                orderId: orderId
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
                            // alert(data);
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
}

                            

                       
                        </script>
                    </div>
                    <?php
            break;
                        }
                    ?>