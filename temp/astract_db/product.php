<?php

class ProductDb {

    protected $connection;

    public function __construct() {

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $link = 'mysql:host=localhost; dbname=proiect; charset=utf8';
        $connection = new PDO($link, 'root', '', $options);

        $this->connection = $connection;
    }
    
    ///////////////////////// selectam tot ////////////////////////////////////
    
    public function getAll()
    {
        $query = $this->connection->query("select * from products order by name asc");
        $products = $query->fetchAll();
        return $products;
    }
    
    //////////////////////// selectam in functie de id ////////////////////////
    
    public function getById ($id)
    {
        $data =[
            'id' => $id
        ];
        
        $query = $this->connection->prepare("select * from products where id = :id");
        $query->execute($data);
        return $query->fetch;
    }
    
    ///////////////////////////////// creem ////////////////////////////////////
    
    public function create ($name, $description, $price, $special_price, $manufacturer_id)
    {
        $data =[
            'manufacturer_id' => $manufacturer_id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'price_special' => $special_price
        ];
        $query = $this->connection->prepare("insert into products (name, description, price, price_special, manufacturer_id) values (:name, :description, :price, :price_special, :manufacturer_id)");
        $query->execute($data);                
    }

    ////////////////////////////// update /////////////////////////////////////
    
    public function update ($id, $name, $description, $price, $special_price, $manufacturer_id)
    {
        $data =[
            'manufacturer_id' => $manufacturer_id,
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'price_special' => $special_price
        ];
        $query = $this->connection->prepare("update products set name = :name, manufacturer_id =:manufacturer_id, description = :description , price = :price , price_special = :price_special where id = :id");
        $query->execute($data);
    }
    
    /////////////////////////////////// delete ////////////////////////////////
    
    public function delete($id)
    {
        $data =[
            'id' => $id
        ];
        $query = $this->connection->prepare("delete from products where id = :id");
        $query->execute($data);
                
    }
}

$productDb = new ProductDb();

$products = $productDb->getAll();
//$productDb->create('Televizor', 'adaugat din php', '700', '50', '1');
//$productDb->update(3, 'Chips', 'Chips cu gust de pui', '10', '5', '1');
//$productDb->delete(4);

echo "<pre>";
print_r($products);