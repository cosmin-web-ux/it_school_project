<?php

require_once 'database.php';

class Product extends Database
{
  protected $tableName = 'products';

  public function create($manufacturer_id, $name, $description, $price, $price_special)
  {
    $data = [
      'manufacturer_id' => $manufacturer_id,
      'name' => $name,
      'description' => $description,
      'price' => $price,
      'price_special' => $price_special
    ];
    $query = $this->connection->prepare("insert into $this->tableName (manufacturer_id, name, description, price, price_special) 
                values (:manufacturer_id, :name, :description, :price, :price_special)");
    $query->execute($data);
  }

  public function update($id, $manufacturer_id, $name, $description, $price, $price_special)
  {
    $data = [
      'id' => $id,
      'manufacturer_id' => $manufacturer_id,
      'name' => $name,
      'description' => $description,
      'price' => $price,
      'price_special' => $price_special
    ];
    $query = $this->connection->prepare("update $this->tableName set manufacturer_id = :manufacturer_id, name = :name, 
                description = :description, price = :price,price_special = :price_special  where id = :id");
    $query->execute($data);
  }
}
