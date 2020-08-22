<?php


class Post
{
    private $conn;
    private $table = 'posts';

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    /**
     * Post constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function read_all()
    {
        $query = 'SELECT 
                      c.name as category_name,
                      p.id,
                      p.category_id,                      
                      p.title,
                      p.body,
                      p.author,
                      p.created_at
                  FROM ' . $this->table . ' p
                  LEFT JOIN categories c ON p.category_id = c.id
                  ORDER BY p.created_at DESC';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute stmt
        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT 
                      c.name as category_name,
                      p.id,
                      p.category_id,                      
                      p.title,
                      p.body,
                      p.author,
                      p.created_at
                  FROM ' . $this->table . ' p
                  LEFT JOIN categories c ON p.category_id = c.id
                  WHERE p.id = ?
                  LIMIT 0,1';

        // prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->category_id = $row['category_id'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->created_at = $row['created_at'];
        $this->category_name = $row['category_name'];

        // TODO: check the following option
//        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
//        if ($stmt->execute()) {
//            return $stmt->fetch();
//        }
    }
}
