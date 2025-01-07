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

// Live search ID
$id = "";

if(isset($_POST['id'])){
    if(empty($_POST['id'])){
        $id = "";
    }
    else{
        $id = $_POST['id'];
    }
}

// Live search Name
$name = "";

if(isset($_POST['name'])){
    if(empty($_POST['name'])){
        $name = "";
    }
    else{
        $name = $_POST['name'];
    }
}

// Live search phone
$phone = "";

if(isset($_POST['phone'])){
    if(empty($_POST['phone'])){
        $phone = "";
    }
    else{
        $phone = $_POST['phone'];
    }
}

// Live search email
$email = "";

if(isset($_POST['email'])){
    if(empty($_POST['email'])){
        $email = "";
    }
    else{
        $email = $_POST['email'];
    }
}

// sorting form data 
$sortId = "";

if(isset($_POST['sortOn'])){
    if(empty($_POST['sortOn'])){
        $sortId = "";
    }
    else{
        $sortId = "order by {$_POST['sortOn']} {$_POST['sortType']}";
    }
}

// Offset of data
$offset = ($current_page - 1) * $limit;



// query to limit data with offset
$sql = "Select * from client_master where id like '%{$_POST['id']}%' and NAME like '%{$_POST['NAME']}%' and phone like '%{$_POST['phone']}%' and address like '%{$_POST['address']}%' and  state like '%{$_POST['state']}%' and email like '%{$_POST['email']}%' and district like '%{$_POST['district']}%' and pincode like '%{$_POST['pincode']}%'  $sortId  limit $offset , $limit";

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
        <td>{$row['NAME']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['email']}</td>
        <td>{$row['address']}</td>
        <td>{$row['state']}</td>
        <td>{$row['district']}</td>
        <td>{$row['pincode']}</td>
        <td class='action-td'>
        <button class='btn bg-primary user-edit-btn' id='{$row['id']}'><i class='bi bi-pencil-square text-light'></i></button>
        <button class='btn bg-danger user-delete-btn' name='user-master-edit-btn' id='{$row['id']}'><i class='bi bi-trash text-light'></i></button>
        </td>
    </tr>";
        $sno++;
    }




    // query to see how many records are in table;
    $sql2 = "SELECT COUNT(*) AS numbers FROM client_master  where id like '%{$_POST['id']}%' and NAME like '%{$_POST['NAME']}%' and phone like '%{$_POST['phone']}%' and address like '%{$_POST['address']}%' and  state like '%{$_POST['state']}%' and email like '%{$_POST['email']}%' and district like '%{$_POST['district']}%' and pincode like '%{$_POST['pincode']}%'   ;";

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
