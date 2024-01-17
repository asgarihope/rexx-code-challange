<?php

namespace Repository;

use Model\SaleModel;

class SaleRepository
{
    protected $saleModel;

    public function __construct(SaleModel $saleModel) {
        $this->saleModel = $saleModel;
    }

    public function addSale(int $saleID,int $userID,int $productID,string $date) {
        return $this->saleModel->createSale($saleID,$userID,$productID,$date);
    }

    public function checkExistSale(int $saleID) {
        return $this->saleModel->checkExistSale($saleID);
    }
}