<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/courses.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare courses object
$courses = new Courses($db);
 
// get id of courses to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of courses to be edited
$courses->id = $data->id;
 
// set courses property values
$courses->kurskod = $data->kurskod;
$courses->progression = $data->progression;
$courses->kursnamn = $data->kursnamn;
$courses->lasperiod = $data->lasperiod;
 
// update the courses
if($courses->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "courses was updated."));
}
 
// if unable to update the courses, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update courses."));
}
?>