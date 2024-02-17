<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'Admin'){
    echo "Access Denied";

}
else {



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
   
  <?php 
   include '../../components/adminNav.php';
   include '../../components/adminSidebar.php';
  
   ?>
    
    <!-- Main Content -->
    <main class="main-content">
      
    </main>
    </script>
  </body>
</html>
<?php
}
?>