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
?>
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

<?php 
 // according to user Type the verification status button are shown.
 // Admin : verification status button
 // Production Staff
 // Delivery Staff
  $userType = $_SESSION['UserType'];

            switch($userType){
                case 'Customer':
                    break;

                case 'Admin':
                    ?> 
                    <div>
                        <button id='verify'>Verify Order</button>
                        <script>
                            const verifyBtn = document.getElementById('verify');
                            verifyBtn.addEventListener("click", 
                            function(){
                                console.log("verified");
                                // <?php
                                // // update the order status to verified 
                                $verifySql = "UPDATE orders set VerificationStatus = 'Verified' where OrderID = '$orderId'";
                                $result = mysqli_query($conn, $verifySql);
                                if($result){
                             ?> 
                                alert("Order Verification Successful.");
                                
                                <?php
                                }

                                ?>
                            })

                        </script>
                    </div>
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