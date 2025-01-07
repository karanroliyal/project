<?php

if (isset($_POST['stateId'])) {


    include "connection.php";

    $sql = "SELECT d.district_name , d.district_id FROM state_master s
    JOIN district_master d
    ON s.state_id = d.state_id 
    WHERE s.state_id = {$_POST['stateId']};";


    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {

        $output = "";

        while ($row = $result->fetch_assoc()) {

            $output .= "<option class='dynamic-city' id='{$row['district_id']}' >{$row['district_name']}</option>";
        }

        echo $output;
    }
}
