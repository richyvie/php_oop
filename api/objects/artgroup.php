<?php
class ArtGroup{
 
    // database connection and table name
    private $conn;
    private $table_name = "tblartgroup";
 
    // object properties
    public $id;
    public $articlegroup;
    public $posOrder;
    public $isBand;
    public $active;
    //public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read articlegroups
    function read(){

        $query = "SELECT * FROM tblartgroup";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                articlegroup=:articlegroup, posOrder=:posOrder, isBand=:isBand, active=:active";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->articlegroup=htmlspecialchars(strip_tags($this->articlegroup));
        $this->posOrder=htmlspecialchars(strip_tags($this->posOrder));
        $this->isBand=htmlspecialchars(strip_tags($this->isBand));
        $this->active=htmlspecialchars(strip_tags($this->active));
    
        // bind values
        $stmt->bindParam(":articlegroup", $this->articlegroup);
        $stmt->bindParam(":posOrder", $this->posOrder);
        $stmt->bindParam(":isBand", $this->isBand);
        $stmt->bindParam(":active", $this->active);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}