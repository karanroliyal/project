
<?php

include "connection.php";

// Limit of data 
$limit = "";

if (isset($_POST['limit'])) {
    $limit = $_POST['limit'];
} else {
    $limit = 5;
}

// Current page in pagination 
$current_page = "";

if (isset($_POST['pageignation_number'])) {
    $current_page = $_POST['pageignation_number'];
} else {
    $current_page = 1;
}

// sorting form data 
$sortId = "";

if (isset($_POST['sortOn'])) {
    if (empty($_POST['sortOn'])) {
        $sortId = "";
    } else {
        $sortId = "order by {$_POST['sortOn']} {$_POST['sortType']}";
    }
}

// Offset of data
$offset = ($current_page - 1) * $limit;



// query to limit data with offset
$sql = "SELECT 
*
FROM invoice_master im
JOIN client_master cm 
ON im.client_id = cm.id where invoice_number like '%{$_POST['invoice_no']}%' and NAME like '%{$_POST['cl_name']}%' and phone like '%{$_POST['cl_phone']}%' and cm.email like '%{$_POST['cl_email']}%' and invoice_date like '%{$_POST['bill_date']}%'  $sortId  limit $offset , $limit";

$result = $conn->query($sql);



// Data to send to html
$tableData = "";
$ulData = "";

if ($result->num_rows > 0) {


    // Sno. value from offset
    $sno = $offset;
    $sno += 1;


    while ($row = $result->fetch_assoc()) {
        $tableData .= "<tr>
                        <td>{$sno}</td>
                        <td>{$row['invoice_id']}</td>
                        <td>{$row['invoice_number']}</td>
                        <td>{$row['invoice_date']}</td>
                        <td>{$row['NAME']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>₹{$row['total_amount']}</td>
                        <td><i class='bi bi-file-earmark-pdf-fill text-danger'></i></td>
                        <td><i class='bi bi-envelope-fill text-primary'></i></td>
                        <td class='action-td'>
                        <button class='btn bg-primary invoice-edit-btn rounded-circle' id='{$row['invoice_id']}'><i class='bi bi-pencil-square text-light'></i></button>
                        <button class='btn bg-danger invoice-delete-btn rounded-circle' id='{$row['invoice_id']}'><i class='bi bi-trash text-light'></i></button>
                        </td>
                     </tr>";
        $sno++;
    }




    // query to see how many records are in table;
    $sql2 = "SELECT 
count(*) numbers
FROM invoice_master im
JOIN client_master cm 
ON im.client_id = cm.id where invoice_number like '%{$_POST['invoice_no']}%' and NAME like '%{$_POST['cl_name']}%' and phone like '%{$_POST['cl_phone']}%' and cm.email like '%{$_POST['cl_email']}%' ;";

    $result2 = $conn->query($sql2);

    $row = $result2->fetch_assoc();

    $total_records = $row['numbers'];

    // Number of pages 
    $pages = ceil($total_records / $limit);

    $ulData .= "<ul class='my-pagination'>";


    for ($i = 1; $i <= $pages; $i++) {

        if ($i == $current_page) {
            $class = 'active-page';
        } else {
            $class = '';
        }
        $ulData .=  "<li id='{$i}' class='{$class}' >{$i}</li>";
    }

    $ulData .= "</ul>";

    // send the html for table and pagination
    echo json_encode(['table' => $tableData, 'pagination' => $ulData]);
} else {

    $tableData .= "<h3>No record Found<h3>";
    echo json_encode(['table' => $tableData, 'pagination' => '']);

    // echo $conn->error;

}
