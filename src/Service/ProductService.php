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
        return $this->productRepository->addProduct($productID, $name, $price);
    }

    public function checkExistProduct(string $name): bool
    {
        return $this->productRepository->checkExistProduct($name);
    }
}