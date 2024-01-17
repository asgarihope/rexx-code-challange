<?php

namespace Service;

use Repository\SaleRepository;

class SaleService
{
    protected $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function addSale(int $saleID, int $userID, int $productID, string $date): int
    {
        if ($this->checkExistSale($saleID)) {
            return 0;
        }
        return $this->saleRepository->addSale($saleID, $userID, $productID, $date);
    }

    public function checkExistSale(int $saleID): bool
    {
        return $this->saleRepository->checkExistSale($saleID);
    }
}