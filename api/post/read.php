<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../models/Post.php';
    $conn = require '../../config/db.php';

    $post = new Post($conn);

    $result = $post->read_all();

    // Get row count
    $num = $result->rowCount();

    if ($num > 0) {
        // Post array
        $posts_arr = array();
        $posts_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $posts_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name,
            );

            // Push to "data"
            array_push($posts_arr['data'], $posts_item);

        }

        // Turn to JSON & output
         echo json_encode($posts_arr);

    } else {
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }
