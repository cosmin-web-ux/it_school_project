<?php

namespace Db;

class Manufacturer extends Database
{
  protected $tableName = 'manufacturers';

  public function create($name)
  {
    $data = [
      'name' => $name
    ];
    $query = $this->connection->prepare("insert into $this->tableName (name) values (:name) ");
    $query->execute($data);
  }

  public function update($id, $name)
  {
    $data = [
      'id' => $id,
      'name' => $name
    ];
    $query = $this->connection->prepare("update $this->tableName set name = :name where id = :id");
    $query->execute($data);
  }
}
