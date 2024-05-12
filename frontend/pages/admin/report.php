<?php
include '../../../backend/db/dbconfig.php';
// get the date
$date = $_GET['date'];


function getAdminDataFromDate($conn, $date){ 
    $customerOrderTotals = array(); // Initialize the array
    // Query for orders
    $sql = "SELECT 
                COUNT(DISTINCT o.OrderID) AS total_orders,
                SUM(CASE WHEN o.VerificationStatus = 'Pending' THEN 1 ELSE 0 END) AS total_pending,
                SUM(CASE WHEN o.VerificationStatus = 'Cancelled' THEN 1 ELSE 0 END) AS total_cancelled,
                SUM(CASE WHEN o.DeliveryStatus = 'Delivered' THEN 1 ELSE 0 END) AS total_delivered
            FROM 
                orders o
            WHERE 
                DATE(o.OrderDate) = '$date'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $customerOrderTotals = array(
            "total_orders" => $row['total_orders'],
            "total_pending" => $row['total_pending'],
            "total_cancelled" => $row['total_cancelled'],
            "total_delivered" => $row['total_delivered']
        );
    }

    // Query for sales
        $sql_sales = "SELECT 
                    count(distinct orderID) as total_sales,
                    SUM(TotalAmount) AS total_cost_price, 
                    SUM(ProfitMade) AS total_profit ,
                    SUM(TotalAmount - ProfitMade) as total_price
                    FROM sales where MoneyReceived ='Yes'
                    and
                    DATE(SalesTimestamp) = '$date'";
                  

    $result_sales = mysqli_query($conn, $sql_sales);

    if ($result_sales && mysqli_num_rows($result_sales) > 0) {
        $row_sales = mysqli_fetch_assoc($result_sales);
        $customerOrderTotals["total_sales"] = $row_sales["total_sales"];
        $customerOrderTotals["total_cost_price"] = $row_sales["total_cost_price"];
        $customerOrderTotals["total_profit"] = $row_sales["total_profit"];
        $customerOrderTotals["total_price"] = $row_sales["total_price"];
    }

    return $customerOrderTotals;
}

// Assuming $conn is your database connection and $date is the desired date

// Call the function to get the data
$adminData = getAdminDataFromDate($conn,$date);
// echo $adminData['total_orders'];

function getProductDataFromDate($conn, $date) {
    $productData = array(); // Initialize an array to store the product data
    // SQL query to fetch product data
    $sql = "SELECT 
                oi.ProductID,
                p.ProductName,
                p.CostPrice,
                SUM(oi.Price) AS total_price,
                SUM(oi.Amount) AS total_amount,
                SUM(oi.Quantity) AS total_quantity
            FROM 
                orderitems oi
            JOIN 
                orders o ON oi.OrderID = o.OrderID
            JOIN 
                sales s ON o.OrderID = s.OrderID
            JOIN 
                products p ON oi.ProductID = p.ProductID
            WHERE 
                DATE(s.SalesTimestamp) = '$date'
                AND o.DeliveryStatus = 'Delivered'
            GROUP BY 
                oi.ProductID";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($result) {
        // Check if there are rows returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch associative array of the result
            while ($row = mysqli_fetch_assoc($result)) {
                // Add each row to the productData array
                $productData[] = $row;
            }
        }
    } else {
        // If query fails, show error message
        echo "Error: " . mysqli_error($conn);
    }

    // Return the productData array
    return $productData;
}
$productData = getProductDataFromDate($conn, $date);

?>


<head>
  <link rel="stylesheet" href="invoiceStyle.css" />
  <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <!-- <script src="invoice.js"></script> -->
</head>
  <!-- Details and view Print preveiew -->
  <div class="details" align='center'>
    <button id="printPreview" onclick="window.print()">
      View Preview
      <!-- <a href="javascript:window.print()"> View Preview </a> -->
    </button>
    <button class="download" onclick="generatePdf()">Download</button>
  </div>
  <br>
  <div class="center-container">
  <div id="invoice-container"  align ='center'>
    <div>
      <h1 align="center">Report on Business</h1>
      <span align='right'><h3 style='margin-right:1rem'>Date: <span><?php echo $date ?></h3></span></span>
      <!-- <h3 align="center">Lalitpur, Nepal</h3>
      <h4 align="center">5555721, 9874563210</h4> -->
    </div>
    <div id="invoice-detail">

      <h3 align='left'> Order Overview:</h3>
    <div class="order-details">
        <div class="order-details-section">
            <span>TOTAL ORDERS:</span>
            <span><?php echo $adminData['total_orders'] ?></span>
        </div>
       
        <div class="order-details-section">
            <span>TOTAL CANCELLED:</span>
            <span><?php echo $adminData['total_cancelled'] ?></span>
        </div>
    </div>
    <div class="order-details">
        <div class="order-details-section">
            <span>TOTAL DELIVERED:</span>
            <span><?php echo $adminData['total_delivered'] ?></span>
        </div>
     
        <div class="order-details-section">
            <span>TOTAL PENDING:</span>
            <span><?php echo $adminData['total_pending'] ?></span>
        </div>
    </div>
</div>


    <div class="description-table">
      <h3>Sold Product Details:</h3>
      <?php
    // Check if any data is returned
if (!empty($productData)) {
    // Output table header
    echo "<table border='1'>
            <tr>
                <th>S.No</th>
                <th>Product Name</th>
                
                <th>Total Price</th>
                <th>Total Quantity</th>
                <th>Total Amount</th>
                
            </tr>";
    
    // Loop through the product data and display it in table rows
    $counter = 1;
    foreach ($productData as $product) {
        echo "<tr>";
        echo "<td>" . $counter. "</td>";
        echo "<td>" . $product['ProductName'] . "</td>";
       // echo "<td>" . $product['CostPrice'] . "</td>";
        echo "<td>" . $product['total_price'] . "</td>";
        echo "<td>" . $product['total_quantity'] . "</td>";
        echo "<td>" . $product['total_amount'] . "</td>";
        echo "</tr>";
        $counter++;
    }

    // Close the table
    echo "</table>";
} else {
    // If no data is returned, display a message
    echo "No product data available.";
}
?>
    </div>
    
    <div class="total-container">
       
      <div class="total-details">
        <h3 >Sales Overview:</h3>
         <div class="total">
          
          <span><b>TOTAL SALES</b></span>
          <span><b><?php echo  $adminData['total_sales'] ?></b></span>
        </div>
        <div class="total">
          <span><b>TOTAL REVENUE</b></span>
          <span><b>Rs.<?php echo $adminData['total_cost_price']?></b></span>
        </div>
         <div class="total">
          <span><b>TOTAL COST</b></span>
          <span><b>Rs.<?php echo $adminData['total_price']?></b></span>
        </div>
       
        <!-- <div class="tax">
          <span>Tax (13%) </span>
          <span>Rs. 25</span>
        </div> -->
        <div class="grand-total">
          <span><b>TOTAL PROFIT</b></span>
          <span> <b>Rs.<?php echo $adminData['total_profit'] ?></b></span>
        </div>
        <!-- <div class="payment">
          <span>Payment Method: </span>
          <span>Cash</span>
        </div> -->
      </div>
    </div>
  </div>
  </div>
  <script>
    function generatePdf() {
      const invoice = document.getElementById("invoice-container");
      // const invoiceNo = document.getElementById("invoiceNo").innerHTML;

      // console.log(invoiceNo);
      html2pdf().from(invoice).save("Invoice");
    }
    // invoice.js
  </script>
</body>
</html>
