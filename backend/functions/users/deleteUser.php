<?php

include '../../db/dbconfig.php';

$userId = $_GET['userId'];

$delete = "Delete from users where UserID = $userId";

$result = mysqli_query($conn,$delete);
if($result){
    echo "User Successfully Deleted";
}else{
    echo "Cannot be deleted.";
}

?>