<?php

if(isset($_POST['id'])){

    include "connection.php";

    $sql = "Delete from user_master where id = {$_POST['id']}";

    if($conn->query($sql)){
        echo $conn->error;
    }else{
        echo "Deleted successfully";
    }



}




?>