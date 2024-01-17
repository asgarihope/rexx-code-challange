<?php

namespace Service;

use Repository\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function addProduct(int $productID,string $name,string $price)
    {
        if ($this->checkExistProduct($productID)) {
            return 0;
        }
        return $this->productRepository->addProduct($productID, $name, $price);
    }

    public function checkExistProduct(int $productID): bool
    {
        return $this->productRepository->checkExistProduct($productID);
    }
}