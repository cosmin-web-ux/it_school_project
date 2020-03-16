<?php

namespace Db;

abstract class Database
{
  protected $connection;
  protected $tableName;

  public function __construct()
  {
    $options = [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    ];
    $link = 'mysql:host=localhost; dbname=project_itschool; charset=utf8';
    $connection = new \PDO($link, 'root', '', $options);

    $this->connection = $connection;
  }

  public function getAll($orderColumn = 'id', $orderWay = 'asc')
  {
    $query = $this->connection->query("select * from $this->tableName order by $orderColumn $orderWay");
    $categories = $query->fetchAll(); // []
    return $categories;
  }

  public function getById($id)
  {
    $data = [
      'id' => $id
    ];
    $query = $this->connection->prepare("select * from $this->tableName where id = :id");
    $query->execute($data);
    return $query->fetch();
  }

  public function delete($id)
  {
    $data = [
      'id' => $id
    ];
    $query = $this->connection->prepare("delete from $this->tableName where id = :id");
    $query->execute($data);
  }
}
