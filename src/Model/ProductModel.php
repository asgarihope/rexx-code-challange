<?php

namespace Model;

class ProductModel extends Model
{

    public function createProduct(int $productID,string $name,float $price): int
    {
        $stmt = $this->db->prepare("INSERT INTO products (product_id,name, price) VALUES (?, ?,?)");
        $stmt->bind_param("isi", $productID,$name, $price);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function checkExistProduct(string $productID): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as counter FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['counter'] ==1;
    }
}