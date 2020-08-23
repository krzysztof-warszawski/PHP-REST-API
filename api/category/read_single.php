<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../models/Category.php';
    $conn = require '../../config/db.php';

    $category = new Category($conn);

    // get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die("No ID has been provided");

    $category->read_single();

    $categories_arr = array(
        'id' => $category->id,
        'category_name' => $category->category_name
    );

    print_r(json_encode($categories_arr));
