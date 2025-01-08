<?php

    include "connection.php";

    $sql = "Select * from client_master";

    $result = $conn->query($sql);

    $object = [];

    if( $result->num_rows > 0 ){

        while($row = $result->fetch_assoc()){

           array_push($object , $row);

        }

        echo json_encode(['object' => $object]);

    }




?>