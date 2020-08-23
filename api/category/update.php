<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,' .
'Access-Control-Allow-Methods, Access-Control-Allow-Origin, X-Requested-With');

require '../../config/Database.php';
require '../../models/Category.php';
$conn = require '../../config/db.php';

$category = new Category($conn);

$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;

$category->category_name = $data->name;

if ($category->update()) {
    echo json_encode(
        array('message' => 'Category Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Category Not Updated')
    );
}
