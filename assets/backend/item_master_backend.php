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


// Live search Name
$name = "";

if (isset($_POST['name'])) {
    if (empty($_POST['name'])) {
        $name = "";
    } else {
        $name = $_POST['name'];
    }
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
$sql = "Select * from item_master where item_name like '%{$_POST['NAME']}%'  $sortId  limit $offset , $limit";

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
        <td>{$row['id']}</td>
        <td>{$row['item_name']}</td>
        <td>₹{$row['item_price']}</td>
        <td>{$row['item_description']}</td>
        <td class='myImageTd' ><img src='assets".substr($row['item_image'] , 2)."'></td>
        <td class='action-td'>
        <button class='btn bg-primary user-edit-btn' id='{$row['id']}'><i class='bi bi-pencil-square text-light'></i></button>
        <button class='btn bg-danger user-delete-btn' name='user-master-edit-btn' id='{$row['id']}'><i class='bi bi-trash text-light'></i></button>
        </td>
    </tr>";
        $sno++;
    }




    // query to see how many records are in table;
    $sql2 = "SELECT COUNT(*) AS numbers FROM item_master  where item_name like '%{$_POST['NAME']}%' ";

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
}
