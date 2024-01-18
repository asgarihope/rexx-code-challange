<?php

namespace Repository;

use Model\SaleModel;

class SaleRepository
{
    protected $saleModel;

    public function __construct(SaleModel $saleModel)
    {
        $this->saleModel = $saleModel;
    }

    public function addSale(int $saleID, int $userID, int $productID, string $date)
    {
        return $this->saleModel->createSale($saleID, $userID, $productID, $date);
    }

    public function checkExistSale(int $saleID)
    {
        return $this->saleModel->checkExistSale($saleID);
    }

    public function filter(
        string  $startDate,
        string  $endDate,
        ?string $userName = null,
        ?string $email = null,
        ?string $productName = null,
        int     $limit = 10,
        int     $offset = 0
    )
    {
        return $this->saleModel->getFilteredSales(
            $startDate,
            $endDate,
            $userName,
            $email,
            $productName,
            $limit,
            $offset
        );
    }
}