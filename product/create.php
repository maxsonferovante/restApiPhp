<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate student object
include_once '../objects/student.php';
 
$database = new Database();
$db = $database->getConnection();
 
$student = new Student($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set student property values
$student->name = $data->name;
$student->price = $data->price;
$student->description = $data->description;
$student->category_id = $data->category_id;
$student->created = date('Y-m-d H:i:s');
 
// create the product
if($student->create()){
    echo '{';
        echo '"message": "Student was created."';
    echo '}';
}
 
// if unable to create the Student, tell the user
else{
    echo '{';
        echo '"message": "Unable to create student."';
    echo '}';
}
?>