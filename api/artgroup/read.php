<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/artgroup.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$artgroup = new ArtGroup($db);
 
// query products
$stmt = $artgroup->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $artgroups_arr=array();
    $artgroups_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $artgroup_item=array(
            "id" => $id,
            "articlegroup" => $articlegroup,
            "posOrder" => $posOrder,
            "isBand" => $isBand,
            "active" => $active
        );
 
        array_push($artgroups_arr["records"], $artgroup_item);
    }
 
    echo json_encode($artgroups_arr);
}
 
else{
    echo json_encode(
        array("message" => "No article groups found.")
    );
}
?>