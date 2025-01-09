<?php


if(isset($_POST['str'])){


    include "connection.php";

    $sql = "Select * from item_master where item_name like '%{$_POST['str']}%'";

    $result = $conn->query($sql);

    $object = [];

    if( $result->num_rows > 0 ){

        while($row = $result->fetch_assoc()){

           array_push($object , $row);

        }

        echo json_encode(['object' => $object]);

    }
    else{
        echo 0 ;
    }

}




?>