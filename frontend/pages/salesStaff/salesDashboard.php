

<?php 
session_start();
if(!isset($_SESSION['UserID'])){
header('location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php');
}

if( $_SESSION['UserType'] != 'SalesStaff'){
    echo "Access Denied";

}
else {
     include '../../components/salesNav.php';
    
?>
 <h1>Hello there! salesMan: THis is dashbaord;</h1>
<div class="hero">


 <?php
  include '../../components/salesSidebar.php';
?>



</div>
<?php
}
?>