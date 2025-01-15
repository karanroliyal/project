<?php

include_once "connection.php";

// Pie chart data

// item 
$itemSql = "select Count(id) as num from item_master";

$result1 = $conn->query($itemSql);

$row1 = $result1->fetch_assoc();

$item_num = $row1['num'];


// client
$clientSql = "select Count(id) as num from client_master";

$result2 = $conn->query($clientSql);

$row2 = $result2->fetch_assoc();


$client_num = $row2['num'];


// user
$userSql = "select Count(id) as num from user_master";

$result3 = $conn->query($userSql);

$row3 = $result3->fetch_assoc();

$user_num = $row3['num'];


// invoice
$invoiceSql = "select Count(invoice_id) as num , SUM(total_amount) AS total  from invoice_master;";

$result4 = $conn->query($invoiceSql);

$row4 = $result4->fetch_assoc();

$invoice_num = $row4['num'];

$invoice_total = $row4['total'];


// Line chart data 

$sql = " SELECT   im.item_name, im.item_price ,SUM(i.quantity) quantity , SUM(i.amount) total
 FROM item_master im 
 JOIN invoice i 
 ON im.id = i.item_id 
 JOIN invoice_master inm
 ON inm.invoice_id = i.invoice_id
 GROUP BY item_name;";

$linedata = $conn->query($sql);

if($linedata->num_rows > 0){

    $line = [];

    while($rowData = $linedata->fetch_assoc()){

        array_push($line , $rowData);

    }

}




echo json_encode([ 'item'=>$item_num , 'client'=>$client_num , 'user'=>$user_num , 'invoice'=>$invoice_num , 'total'=>$invoice_total , 'lineData'=>$line ]);


?>