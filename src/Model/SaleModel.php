<?php

namespace Model;

use Helper\Helper;

class SaleModel extends Model
{

    public function createSale(int $saleID, int $userID, int $productID, string $date): int
    {
        $stmt = $this->db->prepare("INSERT INTO sales (sale_id,user_id,product_id,date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $saleID, $userID, $productID, $date);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function checkExistSale(string $saleID): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as counter FROM sales WHERE sale_id = ?");
        $stmt->bind_param("i", $saleID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['counter'] == 1;
    }


    private function totalRecords(
        string $userNameCondition,
        string $emailCondition,
        string $productNameCondition,
        string $startDate,
        string $endDate,
        int    $limit
    ): int
    {

        $totalCountQuery = "SELECT COUNT(*) AS total_count
                        FROM sales s
                        JOIN products p ON s.product_id = p.product_id
                        JOIN users u ON s.user_id = u.id
                        WHERE
                            $userNameCondition
                            AND $emailCondition
                            AND $productNameCondition
                            AND s.date >= '$startDate'
                            AND s.date < '$endDate'";


        $resultCount = $this->db->query($totalCountQuery);
        $totalCount = 0;
        if ($resultCount) {
            $countRow = $resultCount->fetch_assoc();
            $totalCount = $countRow['total_count'];
        }


        return ceil($totalCount / $limit);

    }

    private function sumSales(
        string $userNameCondition,
        string $emailCondition,
        string $productNameCondition,
        string $startDate,
        string $endDate
    ): int
    {
        $totalPriceQuery = "SELECT SUM(p.price) AS total_price
                FROM sales s
                JOIN products p ON s.product_id = p.product_id
                JOIN users u ON s.user_id = u.id
                WHERE
                    $userNameCondition
                    AND $emailCondition
                    AND $productNameCondition
                    AND s.date >= '$startDate'
                    AND s.date < '$endDate'";
        $resultTotal = $this->db->query($totalPriceQuery);
        $totalPrice = 0;
        if ($resultTotal) {
            $totalRow = $resultTotal->fetch_assoc();
            $totalPrice = $totalRow['total_price'] ?? 0;
        }
        return $totalPrice;
    }

    public function getFilteredSales(
        string  $startDate,
        string  $endDate,
        ?string $userName = null,
        ?string $email = null,
        ?string $productName = null,
        int     $limit = 10,
        int     $page = 1
    ): array
    {
        $offset = ($page - 1) * $limit;

        $startDate = $this->db->real_escape_string($startDate);
        $endDate = $this->db->real_escape_string($endDate);
        $userName = $userName ? $this->db->real_escape_string($userName) : null;
        $email = $email ? $this->db->real_escape_string($email) : null;
        $productName = $productName ? $this->db->real_escape_string($productName) : null;

        $userNameCondition = $userName ? "u.name LIKE '%$userName%'" : "1=1";
        $emailCondition = $email ? "u.email LIKE '%$email%'" : "1=1";
        $productNameCondition = $productName ? "p.name LIKE '%$productName%'" : "1=1";


        $sql = "SELECT
        s.sale_id,
        p.name AS product_name,
        u.id AS user_id,
        u.name AS user_name,
        u.email,
        s.date,
        p.price
    FROM sales s
    JOIN products p ON s.product_id = p.product_id
    JOIN users u ON s.user_id = u.id
    WHERE
        $userNameCondition
        AND $emailCondition
        AND $productNameCondition
        AND s.date >= '$startDate'
        AND s.date < '$endDate'
    ORDER BY s.date DESC
    LIMIT ? OFFSET ?";


        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $salesData = [];
        while ($row = $result->fetch_assoc()) {
            $salesData[] = $row;
        }

        return [
            'data' => $salesData,
            'total_price' => $this->sumSales($userNameCondition, $emailCondition, $productNameCondition, $startDate, $endDate),  // Total sum of prices
            'total_pages' => $this->totalRecords($userNameCondition, $emailCondition, $productNameCondition, $startDate, $endDate, $limit),  // Total sum of prices
        ];
    }


}