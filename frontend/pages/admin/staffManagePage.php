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
    <title>Staffs </title>
    <link rel="stylesheet" href='../../components/forms/addprod.css' />
    <link rel="stylesheet" href='../../components/sidebar/sidebar.css' />
    <link rel="stylesheet" href='../../components/popups/popup.css' />
    <link rel="stylesheet" href='../../components/tables/table.css' />
    
   <style>
    .frame-wrapper{
    /* background-color:aqua; */
    height:90%;
    display:flex;
    /* flex-direction:column; */
    /* top:10; */
    align-items: center;
    justify-content:center;
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
        <h2>Staffs</h2>
        <!-- <div class="date">
          <input type="date" />
        </div> -->
      </div>

      <div class="user-container">
        <button id ='addStaffBtn'>&plus; Add Staff</button>
       <table id ='userTableBody'>
        <thead>
        <th>S.No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <!-- <th>Email</th> -->
        <th>User Type</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th colspan= 2  >Actions</th>
        </thead>

        <?php


        ?>

       </table>

      </div>
       <div id="orderDetailFrame" class = "modal" style="display: none;">
                    <!-- Close button for the iframe -->
                    <span id="closeFrame">&times;</span><br>
                    <div class="frame-wrapper">
                    <!-- <button id="closeFrame">Close</button><br> -->

                    <iframe id="iframeContent" class = "modal-content">
                     

                    </iframe>

                    </div>
                    
                </div>
        </main>
   </div>
    
   <script>
    // Delete functinality:
    // Function to handle user deletion confirmation
    function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete?")) {
        // Send fetch request to delete user
        fetch(`http://localhost/InventoryAndSalesManagement/backend/functions/users/deleteUser.php?userId=${userId}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (response.ok) {
                // Reload the page after successful deletion
                location.reload();
            } else {
                // Handle error, maybe show a message to the user
                console.error('Failed to delete user');
            }
            return response.text(); // Parse response as text
        })
        .then(message => {
            // Display the message returned from the backend
            alert(message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

    const userTableBody = document.getElementById('userTableBody');

    fetch('http://localhost/InventoryAndSalesManagement/backend/functions/users/users.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(users => {
        users.forEach((user, index) => {
            const row = document.createElement("tr")
            row.innerHTML = `
              
                    <td>${index + 1}</td>
                    <td>${user.FirstName}</td>
                    <td>${user.LastName}</td>
                   
                    <td>${user.UserType}</td>
                    <td>${user.PhoneNumber}</td>
                    <td>${user.Address}</td>
                    <td><a href= "#" class ='editBtn'  data-userid="${user.UserID}"> Edit </a></td>
                    <td><a onclick="confirmDelete(${user.UserID})" class ='deleteBtn'>Delete</a></td>
                   
               
            `;

            userTableBody.appendChild(row);
            
        });
    });
</script>
<script>
 
  const addProdModel = document.getElementById("modelPopup");



 // Show iframe for the user form
      document.addEventListener("DOMContentLoaded", function () {
    const addStaffBtn = document.getElementById("addStaffBtn");
    const editBtn = document.getElementById("editBtn");
    const iframeContainer = document.getElementById("orderDetailFrame");
    const closeIframeButton = document.getElementById("closeFrame");
    const iframeContent = document.getElementById("iframeContent");

      // Show Add user Form:
      addStaffBtn.addEventListener("click",function(){
        iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/admin/addStaffForm.php`;
        iframeContainer.style.display = "block"; // Show iframe container

      })
// EDIT

   
        // Show iframe for updateuser page when Edit button is clicked
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains('editBtn')) {
                event.preventDefault();
                const userId = event.target.getAttribute("data-userid");
                const iframeContainer = document.getElementById("orderDetailFrame");
                const iframeContent = document.getElementById("iframeContent");
                iframeContent.src = `http://localhost/InventoryAndSalesManagement/frontend/pages/admin/updateUser.php?userId=${userId}`;
                iframeContainer.style.display = "block";
            }
        });

        




        closeIframeButton.addEventListener("click", function () {
        iframeContainer.style.display = "none"; // Hide iframe container
        iframeContent.src = "";// Reset iframe src

        location.reload(); 
    });
});



</script>
</body>
</html>

<?php
}?>