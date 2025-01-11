<?php

// print_r($_POST);



if (isset($_POST)) {

    // my connection
    include "connection.php";

    // Convert to the desired format

    $dateString = "{$_POST['bill_date']}";
    $date = DateTime::createFromFormat('d/m/Y', $dateString);

    $myBillDate = $date->format('Y-m-d');

    // counting items
    
    $counting_item = 0;

    $itemIds = $_POST['item_id'];
    $quantities = $_POST['item_quantity'];
    $itemNames = $_POST['item_name'];
    $prices = $_POST['item_price'];
    

    for ($i = 0; $i < count($itemIds); $i++) {
        if (!empty($itemIds[$i])  && !empty($quantities[$i])  ) {
            $counting_item += 1;
        }
    }
    // echo "i am counting : " . $counting_item;

    if (isset($_POST['client_id'])  && !empty($_POST['client_id'])  && isset($_POST['item_id'])  && isset($_POST['item_quantity']) && $counting_item > 0) {



        // Calculate total amount
        $total_amount = 0;
        for ($i = 0; $i < count($itemIds); $i++) {
            if (!empty($itemIds[$i]) &&  !empty($quantities[$i]) && !empty($itemNames[$i])) {
                $total_amount += $quantities[$i] * $prices[$i];
            }
        }

        // inserting data into invoice_master 
        $sql = "UPDATE invoice_master SET invoice_date = '$myBillDate' , client_id = {$_POST['client_id']} , total_amount = $total_amount WHERE invoice_id = {$_POST['invoice_update_id']};";


        $invoice_master_update_query = $conn->query($sql);


        if ($invoice_master_update_query === TRUE) {

            $sql2 = "Delete from invoice where invoice_id = {$_POST['invoice_update_id']}";

            $delete_invoice = $conn->query($sql2);

            if($delete_invoice === TRUE){

                for ($i = 0; $i < count($itemIds); $i++) {

                    if (!empty($itemIds[$i]) &&  !empty($quantities[$i]) && !empty($itemNames[$i])) {
    
                        $amount = $prices[$i] * $quantities[$i];
    
                        // inserting data into invoice
                        $sql3 = "insert into invoice values ( {$_POST['invoice_update_id']} , $itemIds[$i] ,  $quantities[$i] , $amount ) ";
    
                       $insert_into_invoice =  $conn->query($sql3);
    
                    }
                }

                echo "success";

            }
            
        } else {

            echo "Unable to generate data";
        }
    } else {
        echo "required";
    }
}
