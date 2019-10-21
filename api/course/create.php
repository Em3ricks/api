<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../config/database.php';
include '../objects/courses.php';
 
$db_connection = new Database();
$conn = $db_connection->getConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));

//CREATE MESSAGE ARRAY AND SET EMPTY
$msg['message'] = '';

// CHECK IF RECEIVED DATA FROM THE REQUEST
if(isset($data->kurskod) && isset($data->progression) && isset($data->kursnamn) && isset($data->kursplan)){
    // CHECK DATA VALUE IS EMPTY OR NOT
    if(!empty($data->kurskod) && !empty($data->progression) && !empty($data->kursnamn) && isset($data->kursplan)){
        
        $insert_query = "INSERT INTO `courses`(kurskod,progression,kursnamn,kursplan) VALUES(:kurskod, :progression, :kursnamn, :kursplan)";
        
        $insert_stmt = $conn->prepare($insert_query);

        // DATA BINDING
        $insert_stmt->bindValue(':kurskod', htmlspecialchars(strip_tags($data->kurskod)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':progression', htmlspecialchars(strip_tags($data->progression)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':kursnamn', htmlspecialchars(strip_tags($data->kursnamn)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':kursplan', htmlspecialchars(strip_tags($data->kursplan)),PDO::PARAM_STR);
        
        if($insert_stmt->execute()){
            $msg['message'] = 'Data Inserted Successfully';
        }else{
            $msg['message'] = 'Data not Inserted';
        } 
        
    }else{
        $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
    }
}
else{
    $msg['message'] = 'Please fill all the fields | kurskod, progression, kursnamn, kursplan';
}

//ECHO DATA IN JSON FORMAT
echo json_encode($msg);

 


