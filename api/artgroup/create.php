<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/artgroup.php';
 
$database = new Database();
$db = $database->getConnection();
 
$artgroup = new ArtGroup($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$artgroup->articlegroup = $data->articlegroup;
$artgroup->posOrder = $data->posOrder;
$artgroup->isBand = $data->isBand;
$artgroup->active = $data->active;
 
// create the product
if($artgroup->create()){
    echo '{';
        echo '"message": "Article group was created."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Article group to create product."';
    echo '}';
}
?>