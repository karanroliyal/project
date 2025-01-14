<?php
session_start();

$email = $_POST['user_email'];
$password = $_POST['user_password'];


if(empty($email) || empty($password)){
    echo 0;
}
else{

    include "connection.php";

    $sql = "SELECT * FROM user_master WHERE email = '{$email}' && password = '{$password}'";

    $result = $conn->query($sql);

    // echo $sql;

    if($result->num_rows > 0){
        echo 11;
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['user_name'] = $row['NAME'];
    }
    else{
        1;
    }


}


?>