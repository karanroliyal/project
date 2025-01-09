<?php

include "connection.php";

// Limit of data 
$limit = "";

if (isset($_POST['page_limit'])) {
    $limit = $_POST['page_limit'];
} else {
    $limit = 5;
}

// Current page in pagination 
$current_page = "";

if (isset($_POST['curr_page'])) {
    $current_page = $_POST['curr_page'];
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

if(isset($_POST['sort'])){
    if(empty($_POST['sort'])){
        $sortId = "";
    }
    else{
        $sortId = "order by {$_POST['sortIN']} {$_POST['sort']}";
    }
}

// Offset of data
$offset = ($current_page - 1) * $limit;



// query to limit data with offset
$sql = "Select * from user_master where id like '%$id%' and NAME like '%$name%' and phone like '%$phone%' and email like '%$email%' $sortId  limit $offset , $limit";

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
        <td class='action-td'>
        <button class='btn bg-primary user-edit-btn rounded-circle' id='{$row['id']}'><i class='bi bi-pencil-square text-light'></i></button>
        <button class='btn bg-danger user-delete-btn rounded-circle' name='user-master-edit-btn' id='{$row['id']}'><i class='bi bi-trash text-light'></i></button>
        </td>
    </tr>";
        $sno++;
    }




    // query to see how many records are in table;
    $sql2 = "SELECT COUNT(*) AS numbers FROM user_master  where id like '%$id%' and NAME like '%$name%' and phone like '%$phone%' and email like '%$email%'   ;";

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
