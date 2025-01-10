<?php

if (isset($_POST['id'])) {

    include "connection.php";

    $sql = "SELECT 
            *
            FROM invoice_master im
            JOIN client_master cm 
            ON im.client_id = cm.id where invoice_id =   {$_POST['id']} ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $clientData =  $row;

    } else {
        echo "Something went wrong " . $conn->error;
    }


    $sql2 = "SELECT * , count(*) count FROM invoice i
            JOIN item_master im
            ON im.id = i.item_id
            WHERE invoice_id =  {$_POST['id']} ";


    $result2 = $conn->query($sql2);

    if($result2->num_rows > 0){

        while($row = $result2->fetch_assoc()){

            $itemData = $row;

        }

    }

    


    echo json_encode(['clientData' => $clientData , 'itemdata' => $itemData ]);


}
