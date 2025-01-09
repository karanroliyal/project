<?php


$emptyArr = [];

if (isset($_POST)) {
    foreach ($_POST as $key => $value) {
        if ($key == 'id') {
            continue;
        }
        if (empty(trim($value))) {
            array_push($emptyArr, $key);
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



$fields = [
    ['value' => trim($_POST['name'] ?? ''), 'regexp' => '/^[a-zA-Z\ ]{3,30}$/', 'name' => 'name'],
    ['value' => trim($_POST['email'] ?? ''), 'regexp' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'name' => 'email'],
    ['value' => trim($_POST['phone'] ?? ''), 'regexp' => '/^[0-9]{10}$/', 'name' => 'phone'],
    ['value' => trim($_POST['address'] ?? ''), 'regexp' => "/^[a-zA-Z0-9\s,'-]+$/", 'name' => 'address'],
    ['value' => trim($_POST['state'] ?? ''), 'regexp' => "/.*./         ", 'name' => 'state'],
    ['value' => trim($_POST['district'] ?? ''), 'regexp' => "/.*./", 'name' => 'district'],
    ['value' => trim($_POST['pincode'] ?? ''), 'regexp' => "/^[0-9]{6}$/", 'name' => 'pincode'],
];

foreach ($fields as $field) {

    $validObj = new formValidation($field['value'], $field['regexp'], $field['name']);

    $validObj->validation();
}



$duplicateEmail = [];

if(isset($_POST['email'])){

    include "connection.php";
    
    $sql2 = "SELECT email FROM client_master WHERE email = '{$_POST['email']}'";
    
    $result = $conn->query($sql2);
    
    if($result->num_rows > 0){
        array_push($duplicateEmail , 'email');
    }
}


$duplicatePhone = [];

if(isset($_POST['phone'])){

    include "connection.php";
    
    $sql3 = "SELECT phone FROM client_master 
    WHERE phone = {$_POST['phone']}";
    
    $result = $conn->query($sql3);
    
    if($result->num_rows > 0){
        array_push($duplicatePhone , 'phone');
    }
    
}




$submitSuccess = "";

if (empty($emptyArr) && empty($validationArr) && empty($duplicateEmail) && empty($duplicatePhone)) {

    include "connection.php";

    $sql = "Insert into client_master values (null , '{$_POST['name']}'  , '{$_POST['phone']}', '{$_POST['email']}', '{$_POST['address']}' , '{$_POST['state']}' , '{$_POST['district']}' , '{$_POST['pincode']}') " ;

    $conn->query($sql);

    $submitSuccess =  "1";
}


echo json_encode(['empty' => $emptyArr , 'valid' => $validationArr , 'duplicateEmail' => $duplicateEmail , 'success' => $submitSuccess , 'duplicatePhone' => $duplicatePhone ]);


// print_r($_POST);
