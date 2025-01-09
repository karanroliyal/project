<?php

$emptyArr = [];

if (isset($_POST)) {
    foreach ($_POST as $key => $value) {

        if (empty(trim($value))) {
            if ($key == "item_name") {
                array_push($emptyArr, "item");
            }
            if ($key == "item_price") {
                array_push($emptyArr, "price");
            }
            if ($key == "item_description") {
                array_push($emptyArr, "description");
            }
        }
    }
}


$validationArr = [];

class formValidation
{

    public $value;
    public $regexp;
    public $name;

    public function __construct($value, $regexp, $name)
    {
        $this->value = $value;
        $this->regexp = $regexp;
        $this->name = $name;
    }

    public function validation()
    {
        global $validationArr;

        // global $validationArr;
        if (!preg_match($this->regexp, $this->value)) {
            if ($this->name == "image") {
                return null;
            }
            array_push($validationArr, $this->name);
        } else {
            // Find the key of the element
            $key = array_search($this->name,  $validationArr);

            // If the value exists, remove it
            if ($key !== false) {
                unset($validationArr[$key]);
            }
        }
    }
}


// image path 

$upload_directory = "";


$imageHere = "";


if (empty(trim($_FILES['item_image']['name']))) {

    $imageHere = "";

} else {

    $path = $_FILES['item_image']['name'];
    $upload_directory = '../uploads/' . $path;
    move_uploaded_file($_FILES['item_image']['tmp_name'], $upload_directory);
    $imageHere = ", item_image = '$upload_directory' ";

}



$fields = [
    ['value' => trim($_POST['item_name'] ?? ''), 'regexp' => '/^[a-zA-Z ]+$/', 'name' => 'item'],
    ['value' => trim($_POST['item_price'] ?? ''), 'regexp' => '/^[0-9]+$/', 'name' => 'price'],
    ['value' => trim($_POST['item_description'] ?? ''), 'regexp' => "/^[a-zA-Z0-9 ]{1,255}$/", 'name' => 'description'],
    ['value' => trim($_FILES['item_image']['name'] ?? ''), 'regexp' => "/(\.jpg|\.jpeg|\.png|\.gif)$/i", 'name' => 'image'],
];

foreach ($fields as $field) {

    $validObj = new formValidation($field['value'], $field['regexp'], $field['name']);

    $validObj->validation();
}



$duplicateItem = [];

if (isset($_POST['item_name'])) {

    include "connection.php";

    $sql2 = "SELECT item_name FROM item_master WHERE item_name = '{$_POST['item_name']}' && id != {$_POST['id']}";

    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
        array_push($duplicateItem, 'item');
    }
}







$submitSuccess = "";

$myQuery="";

if (empty($emptyArr) && empty($validationArr) && empty($duplicateItem)) {

    include "connection.php";

    $sql = "UPDATE item_master SET item_name = '{$_POST['item_name']}' , item_description = '{$_POST['item_description']}' $imageHere , item_price = {$_POST['item_price']} WHERE id = {$_POST['id']};";

    $conn->query($sql);

    $myQuery = $sql;

    $submitSuccess =  "1";
}


echo json_encode(['empty' => $emptyArr, 'valid' => $validationArr, 'duplicateItem' => $duplicateItem, 'success' => $submitSuccess , 'query' => $myQuery]);
