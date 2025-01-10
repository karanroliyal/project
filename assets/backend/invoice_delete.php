<?php

if (isset($_POST['id'])) {

    include "connection.php";

    $sql = "Delete from invoice where invoice_id = {$_POST['id']}";

    $result = $conn->query($sql);

    if ($result) {
        echo "Deleted invoice_master data successfully";
        $sql2 = "Delete from invoice_master where invoice_id = {$_POST['id']}";

        if ($conn->query($sql2)) {
            echo "Deleted invoice data successfully";
        } else {
            echo $conn->error;
        }
    } else {
        echo $conn->error;
    }
}
