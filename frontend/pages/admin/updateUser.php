<?php
include '../../../backend/db/dbconfig.php';

session_start();
$userId= $_GET['userId'];

// GET THE PRODUCT DETAILS
$getUser = "select * from users where UserID = $userId";
$getResult = mysqli_query($conn, $getUser);

if($getResult){
    $user = mysqli_fetch_assoc($getResult);
           
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <link rel="stylesheet" href="../../components/tables/orderDetailsTable.css">
    <link rel="stylesheet" href="../../components/popups/popup.css">
    <link rel="stylesheet" href="../../components/forms/insertProduct.css">
</head>
<body>

    <form action="" method="" enctype="multipart/form-data" id="userForm">
        <label for="firstName">First Name:</label><br>
        <input type="text" id="firstName" name="firstName" required value="<?php echo isset($user['FirstName']) ? $user['FirstName'] : ''; ?>"><br>

        <label for="LastName">Last Name:</label><br>
        <input type="text" id="LastName" name="lastName" required value="<?php echo isset($user['LastName']) ? $user['LastName'] : ''; ?>"><br>

        <label for="mail">Email:</label><br>
        <input type="email" id="mail" name="email" required value="<?php echo isset($user['Email']) ? $user['Email'] : ''; ?>"><br><br>

        <label for="UserType">UserType:</label><br>
        <select id="UserType" name="userType">
            <option value="Admin" <?php echo ($user['UserType'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="SalesStaff" <?php echo ($user['UserType'] == 'SalesStaff') ? 'selected' : ''; ?>>SalesStaff</option>
            <option value="ProductionStaff" <?php echo ($user['UserType'] == 'ProductionStaff') ? 'selected' : ''; ?>>ProductionStaff</option>
        </select>
        <br><br>

        <label for="Phone">Phone Number:</label><br>
        <input type="number" name="phone" pattern="98\d{8}" title="Phone number must start with 98 and have at least 10 digits" required value="<?php echo isset($user['PhoneNumber']) ? $user['PhoneNumber'] : ''; ?>"><br>

        <label for="Address">Address:</label><br>
        <input type="text" id="address" name="address" required value="<?php echo isset($user['Address']) ? $user['Address'] : ''; ?>"><br>


        <input type="submit" value="Submit">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('userForm');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const formData = new FormData(this); // Create FormData object to send form data

                fetch('http://localhost/InventoryAndSalesManagement/backend/functions/users/updateUser.php?userId=<?php echo $userId?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log(data); // Log the response from the server
                    alert(data); // Show the response in an alert
                           var parentWindow = window.parent;
            
                                    // Close the parent iframe by removing it from the DOM
                                    parentWindow.document.getElementById('orderDetailFrame').remove();
                                    parentWindow.location.reload(); // Reload the page after submission
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    alert("Insert failed"); // Show an alert if insertion failed
                });
            });
        });
    </script>

</body>
</html>
