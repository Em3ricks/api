<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
 
// include av databas- och objektfil
include '../config/database.php';
include '../objects/courses.php';
 
// Instantiering av databas
$database = new Database();
$db = $database->getConnection();

// Instantiering av objekt
$courses = new Courses($db);
 
// Fråga om innehåll
$stmt = $courses->read();
$num = $stmt->rowCount();
 
// Kontrollera om innehåll hittats
if($num>0){
 
    // Array innehållande kurser
    $courses_arr=array();
    $courses_arr["kurslista"]=array();
 
    // Hämta innehåll från tabell
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $course_item=array(
            "kurskod" => $kurskod,
            "progression" => $progression,
            "kursnamn" => $kursnamn,
            "kursplan" => $kursplan
        );
        
        // Lägger innehåll i en array och döper denna till kurslista
        array_push($courses_arr["kurslista"], $course_item);
    }
 
    // Vid lyckad anslutning - 200 OK
    http_response_code(200);
    // Visa värden i json format
    echo json_encode($courses_arr);

}   else{
    // Vid misslyckad anslutning - 404 Not found
    http_response_code(404);
    // Skriv ut felmeddelande
    echo json_encode(
        array("message" => "No courses found.")
    );
}