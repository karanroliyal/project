<?php

// echo "hello php mail";

if (isset($_POST['id'])) {

    include_once "connection.php";

    $sql = "SELECT NAME , email , invoice_id FROM invoice_master im
        JOIN client_master cm 
        ON im.client_id = cm.id WHERE im.invoice_id =  {$_POST['id']} ";

    // echo $sql;

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            echo json_encode(['dataSet' => $row]);
        }
    }
} else {
    echo "No id is comming";
}

?>
