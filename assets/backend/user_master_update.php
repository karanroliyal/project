<?php


$emptyArr = [];

if (isset($_POST)) {
    foreach ($_POST as $key => $value) {
        if ($key == 'password') {
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
    ['value' => trim($_POST['password'] ?? ''), 'regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!%*?&]{8,15}$/', 'name' => 'password'],
    ['value' => trim($_POST['email'] ?? ''), 'regexp' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'name' => 'email'],
    ['value' => trim($_POST['phone'] ?? ''), 'regexp' => '/^[0-9]{10}$/', 'name' => 'phone'],
];

foreach ($fields as $field) {

    if ($field['name'] === 'password' && empty($field['value'])) {
        continue; // Skip the validation for the password field if it's empty
    }

    $validObj = new formValidation($field['value'], $field['regexp'], $field['name']);

    $validObj->validation();
}

$duplicateEmail = [];

if (isset($_POST['email'])) {

    include "connection.php";

    $sql2 = "SELECT email FROM user_master WHERE email= '{$_POST['email']}' && id != {$_POST['id']}";

    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
        array_push($duplicateEmail, 'email');
    }
}




$duplicatePhone = [];

if(isset($_POST['phone'])){

    include "connection.php";
    
    $sql3 = "SELECT phone FROM user_master WHERE phone= {$_POST['phone']} && id != {$_POST['id']}";
    
    $result = $conn->query($sql3);
    
    if($result->num_rows > 0){
        array_push($duplicatePhone , 'phone');
    }
}


$submitSuccess = "";
$submittionerror = "";

$password = "";
if (empty($emptyArr) && empty($validationArr) && empty($duplicateEmail) && empty($duplicatePhone)) {

    include "connection.php";

    if(empty(trim($_POST['password']))){
        $password = "";
    }
    else{
        $password = " , password = '{$_POST['password']}'";
    }

    $sql = "update user_master set Name = '{$_POST['name']}' $password , phone = {$_POST['phone']} , email = '{$_POST['email']}' where id = {$_POST['id']}";

    $conn->query($sql);

    $submitSuccess =  "1";

    $submittionerror = $sql;

}

// sending data to ajax in json format
// echo json_encode(['required' => $emptyArr, 'valid' => $validationArr, 'success' => $submitSuccess ]);
echo json_encode(['required' => $emptyArr, 'valid' => $validationArr, 'success' => $submitSuccess, 'duplicateEmail' => $duplicateEmail , 'error' => $submittionerror , 'duplicatePhone' => $duplicatePhone]);
