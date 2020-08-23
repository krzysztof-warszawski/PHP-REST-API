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

    public function read_single()
    {
        $query = 'SELECT 
                      name as category_name,
                      id,
                      created_at
                  FROM ' . $this->table . ' 
                  WHERE id = ?
                  LIMIT 0,1';

        // prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->created_at = $row['created_at'];
        $this->category_name = $row['category_name'];

        // TODO: check the following option
//        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Post');
//        if ($stmt->execute()) {
//            return $stmt->fetch();
//        }
    }


}
