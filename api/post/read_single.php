<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../../config/Database.php';
require '../../models/Post.php';
$conn = require '../../config/db.php';

$post = new Post($conn);

// get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die("No ID has been provided");

$post->read_single();

$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
);

print_r(json_encode($post_arr));
