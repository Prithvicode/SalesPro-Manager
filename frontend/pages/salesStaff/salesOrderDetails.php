<?php
include '../../../backend/db/dbconfig.php';
include '../../../backend/functions/orders/getOrderItems.php';
session_start();

// Get the order id
$orderId = $_GET['id'];
$salesStaffId = $_SESSION['UserID'];


// Get order details 
$orderItems = getOrderItems($conn, $orderId);

// get productName from productId
function getProductNameCostPriceFromID($conn, $prdId){
    $productName = "";
    $productCostPrice = 0;
   $sql = "SELECT *  FROM products WHERE ProductID = '$prdId'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $productName = $row['ProductName'];
        $productCostPrice = $row['CostPrice'];
    }
    return [$productName,$productCostPrice];   
}

// get customer Details:
function getCustomerDetailFromOrderId(){
   $getCustomerSql = " SELECT orders.*, CONCAT(users.FirstName, ' ', users.LastName) AS Name
                        FROM orders
                        JOIN users ON orders.CustomerID = users.UserID";  
                        
}
// Check if form is submitted
if(isset($_POST['saleEntry'])){
    // Extract form data
    $salesDate = $_POST['salesDate'];
    $totalAmount = $_POST['totalAmount'];
    $paymentType = $_POST['paymentType'];
    // $moneyReceived = $_POST['moneyReceived'];
    $profitMade = $_POST['profitMade'];

    // Insert sales details into database
    $insertSalesSql = "INSERT INTO sales (OrderID, SalesStaffID, SalesTimestamp, TotalAmount, ProfitMade, PaymentType) 
                       VALUES ('$orderId', '$salesStaffId', '$salesDate', '$totalAmount', '$profitMade', '$paymentType')";
    $result = mysqli_query($conn, $insertSalesSql);
    

    // Check if insertion was successful
    if ($result) {
    echo "<script>alert('Sales successfully inserted');</script>";
    // Add a delay of 3 seconds (3000 milliseconds) before redirecting
    echo "<script>setTimeout(function() { window.location.href = 'http://localhost/InventoryAndSalesManagement/frontend/pages/salesStaff/updatedSalesDetails.php?id=$orderId'; }, 500);</script>";
   

    } else {
        echo "<script>alert('Error: Failed to insert sales');</script>";
    }
}else{





?>

     <?php 
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

<!-- show order and custoemr Details -->
<head>
        <link rel="stylesheet" href='../../components/tables/orderDetailsTable.css' />
        <link rel="stylesheet" href='../../components/popups/popup.css' />
        <!-- <link rel="stylesheet" href='statusStyle.css' /> -->
        
<style>
    /* Apply styles to labels */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* Apply styles to inputs */
input[type="date"],
input[type="text"],
select {
    padding: 8px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 70%;
    box-sizing: border-box; /* Ensure padding and border don't add to width */
}

/* Apply styles to select elements */
select {
    /* width: calc(100% - 2px); Adjust width to account for border */
}

/* Apply styles to submit button */
input[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff; /* Blue color */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Apply hover effect to submit button */
input[type="submit"]:hover {
    background-color: #0056b3; /* Darker blue on hover */
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
    $totalProfit = 0;
    $totalCost = 0;

    foreach ($orderItems as $item): 
        
    // Get the respective product name from product Id
        $productName = getProductNameCostPriceFromID($conn, $item['ProductID'])[0];  
        $costPrice = getProductNameCostPriceFromID($conn, $item['ProductID'])[1];

        $totalAmount = $totalAmount + $item['Amount'];

    // calculate total profit = $totalAmount  - $totalCost 
        $totalCost  = $totalCost + $item['Quantity'] * $costPrice;
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
<!-- Form to update and enter sales Status after delivery. -->
<br><br>
<label for="deliveryStatus">Delivery Status: </label>
    <select name="deliveryStatus" id="deliveryStatus">
    <option value="Delivered" <?php if ( $currentDeliveryStatus == 'Delivered') echo 'selected'; ?>>Delivered</option>
    <option value="In Transit" <?php if ( $currentDeliveryStatus == 'In Transit') echo 'selected'; ?>>In Transit</option>
    <option value="Not Delivered" <?php if ( $currentDeliveryStatus == 'Not Delivered') echo 'selected'; ?>>Not Delivered</option>
    </select><br>

<div class="form-container" id='form-container' style = 'display:none'>
<form 
action="" 
method = "POST">
    
    <label for="">Date</label>
    <input type="date" id= 'saleDate'  name = 'salesDate' min="<?php echo date('Y-m-d'); ?>"><br>

    <label for="totalAmount" >Total Amount: </label>
<input 
type="text" name = 'totalAmount' value = <?php echo  $totalAmount?> 
readonly><br>


<label for="paymentType">Payment Type: </label>
 <select name="paymentType" id="paymentType">
        <option value="Online">Online</option>
        <option value="Cash">Cash</option>
    </select><br>


<!-- <label for="moneyReceived">Money Received:</label>
    <select name="moneyReceived" id="moneyReceived">
        <option value="Yes" selected>Yes</option>
        <option value="No">No</option>
    </select><br> -->

<label for="profitMade">Profit Made: </label>
<input type="text"  
value = 
<?php 
        $totalProfit = $totalAmount - $totalCost;
        echo $totalProfit 
?> name = 'profitMade' readonly >

<br>
<br>
<input type="submit" name = 'saleEntry' value ='Enter Sales'>

</form>
 </div>

<script>
    // current date by default
    const dateInput = document.getElementById('saleDate');
    var currentDate = new Date().toISOString().slice(0, 10);
    dateInput.value = currentDate;

    const orderId = <?php echo $orderId?>;
    const deliveryStatusInput = document.getElementById('deliveryStatus');
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
   
    
    // Only show the Sales form if the Delivery Status is Delivered.
    
   
    const formContainer = document.getElementById('form-container');
    function toggleSalesFormVisibility() {
    if (deliveryStatusInput.value === 'Delivered') {
        formContainer.style.display = 'block';
    } else {
        formContainer.style.display = 'none';
    }
    }

    // Event of delivery Status
    deliveryStatus.addEventListener("change",function(){
                updateOrderStatus(orderId,'DeliveryStatus',deliveryStatusInput.value);
                toggleSalesFormVisibility();
    })

  



</script>

 <?php 
}

 

  



 

 // Post sales details




 ?>
