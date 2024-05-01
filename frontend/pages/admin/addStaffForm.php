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
        <input type="text" id="firstName" name="firstName" required><br>

        <label for="LastName">Last Name:</label><br>
        <input type="text" id="LastName" name="LastName" required><br>

        <label for="mail">Email:</label><br>
        <input type="email" id="mail" name="mail" required><br><br>

        <label for="UserType">UserType:</label><br>
        <select id="UserType" name="UserType">
            <option value="Admin">Admin</option>
            <option value="SalesStaff">SalesStaff</option>
            <option value="ProductionStaff">ProductionStaff</option>
        </select>
        <br><br>

        <label for="Phone">Phone Number:</label><br>
        <input type="number" name="Phone" pattern="98\d{8}" title="Phone number must start with 98 and have at least 10 digits" required><br>

        <label for="Address">Address:</label><br>
        <input type="text" id="Address" name="Address" required><br>

        <label for="passw">Password:</label><br>
        <input type="password" id="passw" name="passw" required><br>

        <label for="cpassw">Confirm Password:</label><br>
        <input type="password" id="cpassw" name="cpassw" required><br>

        <input type="submit" value="Submit">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('userForm');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const password = document.getElementById('passw').value;
                const confirmPassword = document.getElementById('cpassw').value;

                if (password !== confirmPassword) {
                    alert("Password and confirm password do not match");
                    return;
                }

                const formData = new FormData(this); // Create FormData object to send form data

                fetch('http://localhost/InventoryAndSalesManagement/backend/functions/users/createUser.php', {
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
                    window.location.reload(); // Reload the page after submission
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
