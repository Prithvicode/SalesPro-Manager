<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'Admin'){
    echo 'Access Denied';
    
}
else{

// Base URL for images
$BASE_URL = "http://localhost/InventoryAndSalesManagement/frontend/components/sidebar/";


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report</title>
    <link rel="stylesheet" href='../../components/forms/addprod.css' />
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
    <link rel="stylesheet" href='../../components/popups/popup.css' />
    <link rel="stylesheet" href='../../components/tables/table.css' />
    <link rel="stylesheet" href="invoiceStyle.css" />
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="invoice.js"></script>

 <style>
       #orderDetailFrame2 {
      background: whitesmoke;
        width: 100%;
       min-height: 100vh; /* Set minimum height to full viewport height */
}

        .frame-wrapper2 {
            /* background: red; */
            width: 100%;
            height: 100%;
            overflow: auto;/* Enable scrolling if content exceeds frame size */
        }

        .modal-content2 {
            width: 100%;
            height: 90%;
            border: none; /* Remove iframe border */
        }
        
        .generate-report-btn {
            
            background-color: #007bff; /* Blue */
            border: none;
            color: white;
            padding:0.5rem;
            /* padding: 15px 32px; */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            /* font-size: 16px; */
            margin-left:2rem;
            cursor: pointer;
            border-radius: 8px;
        }

        .generate-report-btn:hover {
            background-color: #0056b3; /* Darker Blue */
        }
       
    </style>

</head>
 
<body>
  <div class="container">
    <?php
    include '../../components/sidebar/adminSidebar.php'; 
    ?>
    <main>
      <div class="header">
        <h2>Report Generation</h2> 
      </div>
      <div class="header">
        <div id="date-box">
         <b> Select Date:</b> <input type="date" id="selected-date" required>
          <button class='generate-report-btn' onclick="generateReport()">Generate Report</button>
        </div>
      </div>
       
        <div id="orderDetailFrame2" class="modal2" style="display: none;">
          <span id="closeFrame">&times;</span><br>
          <div class="frame-wrapper2">
            <iframe id="iframeContent2" class="modal-content2"></iframe>
          </div>
        </div>
      
    </main>
  </div>
  
  <script>
    // const showOrderDetailsLinks = document.querySelectorAll(".showOrderDetails");
    const iframeContainer = document.getElementById("orderDetailFrame2");
    const closeIframeButton = document.getElementById("closeFrame");
    const iframeContent = document.getElementById("iframeContent2");

    function generateReport() {
    var selectedDate = document.getElementById("selected-date").value;
    if (selectedDate) { // Check if a date is selected
      // Send selected date to report.php
      document.getElementById("iframeContent2").src = "report.php?date=" + selectedDate;
      // Show iframe
      document.getElementById("orderDetailFrame2").style.display = "block";

      // Add event listener to close button
      const closeIframeButton = document.getElementById("closeFrame");
      closeIframeButton.addEventListener("click", function () {
        document.getElementById("orderDetailFrame2").style.display = "none"; // Hide iframe container
        document.getElementById("iframeContent2").src = ""; // Reset iframe src
      });
    } else {
      // Display an error message or prompt the user to select a date
      alert("Please select a date before generating the report.");
    }
  }

      closeIframeButton.addEventListener("click", function () {
        iframeContainer.style.display = "none"; // Hide iframe container
        iframeContent.src = "";// Reset iframe src

        location.reload(); 
    });
  </script>
</body>
</html>
<?php }?>