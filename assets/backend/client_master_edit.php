<?php

if(isset($_POST['id'])){

    include "connection.php";

    $sql = "Select * from client_master where id = {$_POST['id']}";

    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();
        echo json_encode($row);

    }
    else{
        echo "Something went wrong ".$conn->error;
    }



}

?>