<?php

namespace Db;

class User extends Database
{
    protected $tableName = 'users';

    public function create($username, $password)
    {
        $data = [
            'password' => sha1($password),
            'username' => $username
        ];
        $query = $this->connection->prepare("insert into $this->tableName(username, password) values (:username, :password) ");
        $query->execute($data);
    }

    public function update($id, $username, $password)
    {
        $data = [
            'id' => $id,
            'username' => $username,
            'password' => $password

        ];
        $query = $this->connection->prepare("update $this->tableName set username = :username where id = :id");
        $query->execute($data);
    }

    public function getUser($username, $password)
    {
        $data = [
            'user' => $username,
            'pass' => sha1($password)
        ];

        $query = $this->connection->prepare("select * from users where username = :user && password = :pass");
        $query->execute($data);

        return $query->fetch();
    }
}
