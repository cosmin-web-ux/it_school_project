<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

abstract class Database {

    protected $connection;
    protected $tableName;

    public function __construct() {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $link = 'mysql:host=localhost; dbname=proiect; charset=utf8';
        $connection = new PDO($link, 'root', 'root', $options);

        $this->connection = $connection;
    }

    public function getAll($orderColumn = 'id', $orderWay = 'asc') {
        $query = $this->connection->query("select * from $this->tableName order by $orderColumn $orderWay");
        $rows = $query->fetchAll(); // []
        return $rows;
    }

    public function getById($id) {
        $data = [
            'id' => $id
        ];
        $query = $this->connection->prepare("select * from $this->tableName where id = :id");
        $query->execute($data);
        return $query->fetch();
    }

    public function delete($id) {
        $data = [
            'id' => $id
        ];
        $query = $this->connection->prepare("delete from $this->tableName where id = :id");
        $query->execute($data);
    }

}

class CategoryDb extends Database {

    protected $tableName = 'categories';

    public function create($name) {
        $data = [
            'name' => $name
        ];
        $query = $this->connection->prepare("insert into categories (name) values (:name) ");
        $query->execute($data);
    }

}

class ProductsDb extends Database {

    protected $tableName = 'products';
    
}

class ManufacturersDb extends Database {

    protected $tableName = 'manufacturers';

    public function create($name) {
        $data = [
            'name' => $name
        ];
        $query = $this->connection->prepare("insert into manufacturers (name) values (:name) ");
        $query->execute($data);
    }    
    
}

class UserDb extends Database {

    protected $tableName = 'users';

}


$databaseDb = new Database();
//$data = $databaseDb->getAll();

$productDB = new ProductsDb();
$products = $productDB->getAll();


$categoryDb = new CategoryDb();
$categoryDb->create("Laptop-uri");
$categories = $categoryDb->getAll('name', 'desc');

$manufacturersDb = new ManufacturersDb();
$manufacturersDb->create("Samsung");
$manufacturers = $manufacturersDb->getAll();

$usersDb = new UserDb();
$users = $usersDb->getAll();


echo "<pre>";

print_r($products);
print_r($categories);
print_r($manufacturers);
print_r($users);

//$categoryDb = new CategoryDb();
//
//$categories = $categoryDb->getAll();
//$category1 = $categoryDb->getById(1);
//
////$catgoryDb->create("Adaugata din PHP");
////$catgoryDb->update(3, "Modificata din PHP");
//
//$categoryDb->delete(3);
//
//echo "<pre>";
//print_r($categories);
//
