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
            return $saleID;
        }
        return $this->saleRepository->addSale($saleID, $userID, $productID, $date);
    }

    public function checkExistSale(int $saleID): bool
    {
        return $this->saleRepository->checkExistSale($saleID);
    }
    public function filter(
        string $startDate,
        string $endDate,
        ?string $userName = null,
        ?string $email = null,
        ?string $productName = null,
        int $limit = 10,
        int $offset = 0
    ): array
    {
        return $this->saleRepository->filter(
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