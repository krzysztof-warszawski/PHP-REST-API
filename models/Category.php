<?php


class Category
{
    private $conn;
    private $table = 'categories';

    public $id;
    public $category_name;
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
                      name as category_name,
                      id,
                      created_at
                  FROM ' . $this->table . ' 
                  ORDER BY created_at DESC';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute stmt
        $stmt->execute();

        return $stmt;
    }


}
