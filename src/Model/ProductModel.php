<?php

namespace Model;

class ProductModel extends Model
{

    public function createProduct(int $productID,string $name,int $price): int
    {
        $stmt = $this->db->prepare("INSERT INTO products (product_id,name, $price) VALUES (?, ?)");
        $stmt->bind_param("isi", $productID,$name, $price);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function checkExistProduct(string $email): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as counter FROM products WHERE name = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['counter'] ==1;
    }
}