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
        <div>
        <label for="assignStaff">Assign Delivery Staff:</label>  
        <select name="assignStaff" id="assignStaff">
        <?php
        $getDeliveryStaffSql = "SELECT * from users where UserType = 'SalesStaff'";
        $result = mysqli_query($conn, $getDeliveryStaffSql);
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $row['UserID']?>"><?php echo $row['FirstName'].' '.$row['LastName']?></option>
                <?php 
            }
            }

        ?>
        </select>        
        </div>

       
<?php 
  $userType = $_SESSION['UserType'];

            switch($userType){
                case 'Admin':
                    ?> 
                    <div>
                        <button id='assignStaffBtn'>Assign Delivery Staff</button>

                        <script>
                            const assignStaffBtn = document.getElementById('assignStaffBtn');
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

                            assignStaffBtn.addEventListener("click", 
                            function() {
                        const assignedInput = document.getElementById('assignStaff');
                        const selectedOption = assignedInput.selectedOptions[0];
                        const selectedText = selectedOption ? selectedOption.innerText : "No option selected";
                        const orderId = <?php echo $orderId?>;
                        console.log(assignedInput.value);
                        updateOrderStatus(orderId, 'AssignedDeliveryStaffID', assignedInput.value);
                        alert(`Order is assigned to ${selectedText}`);
});


                        </script>
                    </div>
                    <?php
                    break;

               
            }

 




?>