<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../models/Category.php';
    $conn = require '../../config/db.php';

    $category = new Category($conn);

    $result = $category->read_all();

    // Get row count
    $num = $result->rowCount();

    if ($num > 0) {
        // Category array
        $categories_arr = array();
        $categories_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $categories_item = array(
                'id' => $id,
                'category_name' => $category_name,
            );

            // Push to "data"
            array_push($categories_arr['data'], $categories_item);

        }

        // Turn to JSON & output
         echo json_encode($categories_arr);

    } else {
        echo json_encode(
            array('message' => 'No Categories Found')
        );
    }
