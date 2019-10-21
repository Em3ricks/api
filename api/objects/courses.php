<?php
class Courses{

    //Databasanslutning och tabellnamn
    private $conn;
    private $table_name = "courses";

    //Object properties
    public $kurskod;
    public $progression;
    public $kursnamn;
    public $kursplan;

    // Konstruktor
    public function __construct($db){
        $this->conn = $db;
    }

    // Funktion för att läsa ut värden från databas
    function read() {
        // SQL-fråga för att välja samtliga värden
        $query = "SELECT * FROM $this->table_name";
        // Förberedelse av förfrågan
        $stmt = $this->conn->prepare($query);
        // Exikvering av förfrågan
        $stmt->execute();
        return $stmt;
    }

    // Funktion för att radera värden från databas
    function delete(){
        // Förfrågan för att ta bort värde med koppling till dess id
        $query = "DELETE FROM $this->table_name WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
        // execute query
        if($stmt->execute()){
            return true;
        }   return false;
    }

    // Funktion för att uppdatera värden
    function update(){
        // update query
        $query = "UPDATE $this->table_name 
                SET
                    kurskod = :kurskod,
                    progression = :progression,
                    kursnamn = :kursnamn,
                    kursplan = :kursplan
                WHERE
                    id = :id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->kurskod=htmlspecialchars(strip_tags($this->kurskod));
        $this->progression=htmlspecialchars(strip_tags($this->progression));
        $this->description=htmlspecialchars(strip_tags($this->kursnamn));
        $this->kursplan=htmlspecialchars(strip_tags($this->kursplan));
        $this->id=htmlspecialchars(strip_tags($this->id));
        // bind new values
        $stmt->bindParam(':kurskod', $this->kurskod);
        $stmt->bindParam(':progression', $this->progression);
        $stmt->bindParam(':kursnamn', $this->kursnamn);
        $stmt->bindParam(':kursplan', $this->kursplan);
        $stmt->bindParam(':id', $this->id);
        // execute the query
        if($stmt->execute()){
            return true;
        }   return false;
    }     
}