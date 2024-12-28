<?php
session_start();

$email = $_POST['user_email'];
$password = $_POST['user_password'];


if(empty($email) || empty($password)){
    echo 0;
}
else{

    include "connection.php";

    $sql = "SELECT * FROM users WHERE user_email = '{$email}' && user_password = '{$password}'";

    $result = $conn->query($sql);

    // echo $sql;

    if($result->num_rows > 0){
        echo 11;
        $_SESSION['email'] = $email;
    }
    else{
        1;
    }


}


?>