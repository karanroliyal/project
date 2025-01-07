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
        }
        else {
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
    ['value' => trim($_POST['password'] ?? ''), 'regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!%*?&]{8,15}$/', 'name' => 'password'],
    ['value' => trim($_POST['email'] ?? ''), 'regexp' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'name' => 'email'],
    ['value' => trim($_POST['phone'] ?? ''), 'regexp' => '/^[0-9]{10}$/', 'name' => 'phone'],
];

foreach($fields as $field){

    $validObj = new formValidation($field['value'] , $field['regexp'] , $field['name']);

    $validObj->validation();

}

$duplicateEmail = [];

if(isset($_POST['email'])){

    include "connection.php";
    
    $sql2 = "SELECT email FROM user_master WHERE email = '{$_POST['email']}'";
    
    $result = $conn->query($sql2);
    
    if($result->num_rows > 0){
        array_push($duplicateEmail , 'email');
        // $emailDup =  json_encode($duplicateEmail);
    }
}


$duplicatePhone = [];

if(isset($_POST['phone'])){

    include "connection.php";
    
    $sql3 = "SELECT phone FROM user_master 
    WHERE phone = {$_POST['phone']}";
    
    $result = $conn->query($sql3);
    
    if($result->num_rows > 0){
        array_push($duplicatePhone , 'phone');
    }
}


$submitSuccess = "";

if (empty($emptyArr) && empty($validationArr) && empty($duplicateEmail) && empty($duplicatePhone)) {

    include "connection.php";

    $sql = "Insert into user_master values (null , '{$_POST['name']}'  , '{$_POST['phone']}', '{$_POST['email']}', '{$_POST['password']}')";

    $conn->query($sql);

    $submitSuccess =  "1";
}

// sending data to ajax in json format

echo json_encode(['required' => $emptyArr, 'valid' => $validationArr, 'success' => $submitSuccess , 'duplicateEmail' => $duplicateEmail , 'duplicatePhone' => $duplicatePhone ]);
