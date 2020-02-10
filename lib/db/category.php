<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'database.php';

class Category extends Database {

    protected $tableName = 'categories';

    public function create($name) {
        $data = [
            'name' => $name
        ];
        $query = $this->connection->prepare("insert into $this->tableName (name) values (:name) ");
        $query->execute($data);
    }

    public function update($id, $name) {
        $data = [
            'id' => $id,
            'name' => $name
        ];
        $query = $this->connection->prepare("update $this->tableName set name = :name where id = :id");
        $query->execute($data);
    }

}

$categoriesDb = new Category();

//$categories = $categoriesDb->create("tv");
$categories = $categoriesDb->getAll();


echo "<pre>";
print_r($categories);

