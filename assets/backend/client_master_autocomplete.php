<?php


if(isset($_POST['str'])){


    include "connection.php";

    $sql = "Select * from client_master where NAME like '%{$_POST['str']}%'";

    $result = $conn->query($sql);

    $object = [];

    if( $result->num_rows > 0 ){

        while($row = $result->fetch_assoc()){

           array_push($object , $row);

        }

        echo json_encode(['object' => $object]);

    }

}




?>