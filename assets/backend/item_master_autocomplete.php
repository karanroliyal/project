<?php


if(isset($_POST['str'])){


    include "connection.php";

    $strId = "";

    if(isset($_POST['arrId'])){

        $arrId = $_POST['arrId'];
    
        $strId = implode(" ," ,$arrId);
    
        // echo $strId;
    
        if(empty(trim($strId))){
            $strId = "";
        }
        else{
            $strId = "AND id NOT IN ($strId)";
        }

    }



    $sql = "Select * from item_master where item_name like '%{$_POST['str']}%' $strId ;";

    $result = $conn->query($sql);

    $object = [];

    if( $result->num_rows > 0 ){

        while($row = $result->fetch_assoc()){

           array_push($object , $row);

        }

        echo json_encode(['object' => $object , 'query' => $sql]);

    }
    else{
        echo 0;
    }

}




?>