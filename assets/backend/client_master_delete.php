<?php

if(isset($_POST['id'])){

    include "connection.php";

    $sql = "Delete from client_master where id = {$_POST['id']}";

    if($conn->query($sql)){
        echo "Deleted successfully";
    }else{
        echo $conn->error;
    }



}

?>