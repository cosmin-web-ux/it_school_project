<?php

namespace Db;

class Product extends Database
{
    protected $tableName = 'products';

    public function getAll($orderColumn = 'id', $orderWay = 'asc')
    {
        $sql = "SELECT
              products.*,
              manufacturers.name as manufacturer_name,
              product_photos.filename
            FROM `products`
            LEFT JOIN manufacturers
              ON products.manufacturer_id = manufacturers.id
            LEFT JOIN product_photos
              ON products.product_photo_id = product_photos.id
            ORDER by $orderColumn $orderWay";

        $query = $this->connection->query($sql);
        $products = $query->fetchAll();
        return $products;
    }

    public function search($searchText, $orderColumn = 'id', $orderWay = 'asc')
    {
        $data = [
            'searchText' => "%" . $searchText . "%"
        ];

        $sql = "SELECT
              products.*,
              manufacturers.name as manufacturer_name,
              product_photos.filename
            FROM `products`
            LEFT JOIN manufacturers
              ON products.manufacturer_id = manufacturers.id
            LEFT JOIN product_photos
              ON products.product_photo_id = product_photos.id
            WHERE 1
              AND products.name like :searchText
              OR products.description like :searchText
            ORDER BY $orderColumn $orderWay";
        $query = $this->connection->prepare($sql);
        $query->execute($data);

        $products = $query->fetchAll();
        return $products;
    }

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

    public function addPhoto($productId, $fileName)
    {
        $data = [
            'productId' => $productId,
            'filename' => $fileName
        ];

        $query = $this->connection->prepare("insert into product_photos (product_id, filename) values (:productId, :filename)");
        $query->execute($data);
    }

    public function deletePhoto($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("delete from product_photos where id = :id");
        $query->execute($data);
    }

    public function getPhotoById($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("select * from product_photos where id = :id ");
        $query->execute($data);

        return $query->fetch();
    }

    public function getPhotos($productId)
    {
        $data = [
            'productId' => $productId
        ];

        $query = $this->connection->prepare("select * from product_photos where product_id = :productId ");
        $query->execute($data);

        return $query->fetchAll();
    }

    public function setPhoto($photoId, $productId)
    {
        $data = [
            'productId' => $productId,
            'photoId' => $photoId
        ];

        $query = $this->connection->prepare("update products set product_photo_id = :photoId where id = :productId");
        $query->execute($data);
    }

    public function addCategory($categoryId, $productId)
    {
        $data = [
            'categoryId' => $categoryId,
            'productId' => $productId
        ];

        $query = $this->connection->prepare("insert into products_categories (category_id, product_id) values (:categoryId, :productId) ");
        $query->execute($data);
    }

    public function removeCategories($productId)
    {
        $data = [
            'productId' => $productId
        ];

        $query = $this->connection->prepare("delete from products_categories where product_id = :productId");
        $query->execute($data);
    }

    public function getCategoryIds($productId)
    {
        $data = [
            'productId' => $productId
        ];

        $query = $this->connection->prepare("select * from products_categories where product_id = :productId");
        $query->execute($data);

        $dbCategories = $query->fetchAll();

        $categoryIds = [];

        foreach ($dbCategories as $key => $category) {
            $categoryIds[] = $category['category_id'];
        }
        return $categoryIds;
    }
}
