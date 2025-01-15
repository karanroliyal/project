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

   // trying new pagination

    // Calculate the range of pages to show
    $max_visible_pages = 3; // Maximum number of pages to display
    $start_page = max(1, $current_page - 1); // Ensure that the page doesn't go below 1
    $end_page = min($pages, $current_page + 1); // Ensure that the page doesn't exceed the total number of pages

    // If there are fewer than $max_visible_pages, adjust the start and end pages
    if ($pages <= $max_visible_pages) {
        $start_page = 1;
        $end_page = $pages;
    } else {
        // Ensure that the range includes at least 3 pages, adjusting for edge cases
        if ($current_page == 1) {
            $end_page = min($max_visible_pages, $pages);
        } elseif ($current_page == $pages) {
            $start_page = max(1, $pages - $max_visible_pages + 1);
        }
    }

    // Generate pagination buttons with a range of 3 pages
    $ulData = "<nav aria-label='Page navigation example'  >
    <ul class='pagination my-pagination' id='{$pages}'>
        <li class='page-item'>
            <a class='page-link prev'  aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
            </a>
        </li>";

    // Show previous pages and current page
    for ($i = $start_page; $i <= $end_page; $i++) {
        $class = ($i == $current_page) ? 'active' : '';
        $ulData .= "<li id='{$i}' class='page-item li $class'><a class='page-link'>$i</a></li>";
    }

    // Show next pages if there are more
    $ulData .= "
    <li class='page-item'>
        <a class='page-link next'  aria-label='Next'>
            <span aria-hidden='true'>&raquo;</span>
        </a>
    </li>
    </ul>
</nav>";


    // send the html for table and pagination
    echo json_encode(['table' => $tableData, 'pagination' => $ulData]);
} else {

    $tableData .= "<h3>No record Found<h3>";
    echo json_encode(['table' => $tableData, 'pagination' => '']);
}
