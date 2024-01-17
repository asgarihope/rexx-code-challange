<?php

namespace Repository;

use Model\ProductModel;
use Model\UserModel;

class ProductRepository
{
    protected $productModel;

    public function __construct(ProductModel $productModel) {
        $this->productModel = $productModel;
    }

    public function addProduct(int $productID,string $name,int $price) {
        return $this->productModel->createProduct($productID,$name, $price);
    }

    public function checkExistProduct(string $name) {
        return $this->productModel->checkExistProduct($name);
    }
}