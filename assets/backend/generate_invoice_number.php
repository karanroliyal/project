<?php


    include "connection.php";


    $sql = "SELECT invoice_id FROM invoice_master ORDER BY invoice_id DESC LIMIT 1;";


    $result = $conn->query($sql);

    if( $result->num_rows > 0 ){

        if($row= $result->fetch_assoc()){

            echo $row['invoice_id'];

        }

    }




?>