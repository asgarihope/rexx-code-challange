<?php

namespace Model;

class SaleModel extends Model
{

    public function createSale(int $saleID,int $userID,int $productID,string $date): int
    {
        $stmt = $this->db->prepare("INSERT INTO sales (sale_id,user_id,product_id,date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $saleID,$userID,$productID, $date);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function checkExistSale(string $saleID): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as counter FROM sales WHERE id = ?");
        $stmt->bind_param("i", $saleID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['counter'] ==1;
    }
}