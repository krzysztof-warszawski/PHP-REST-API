<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,' .
    'Access-Control-Allow-Methods, Access-Control-Allow-Origin, X-Requested-With');

require '../../config/Database.php';
require '../../models/Post.php';
$conn = require '../../config/db.php';

$post = new Post($conn);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

if ($post->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}
