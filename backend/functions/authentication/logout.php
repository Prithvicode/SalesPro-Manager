<?php
session_start();

if(isset($_SESSION['UserID'])){
    // if session log is set 
    session_unset();
    session_destroy();
    header("location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php");

}else{
    // if session not set
    header("location: http://localhost/InventoryAndSalesManagement/frontend/pages/loginPage.php");
}

?>