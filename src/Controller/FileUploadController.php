<?php

use Helper\Helper;
use Model\ProductModel;
use Model\SaleModel;
use Model\UserModel;
use Repository\ProductRepository;
use Repository\SaleRepository;
use Repository\UserRepository;
use Service\ProductService;
use Service\SaleService;
use Service\UserService;

class FileUploadController
{

    private $db;
    /**
     * @var \Service\UserService
     */
    private $productService;
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var SaleService
     */
    private $saleService;

    public function __construct(mysqli $db)
    {
        $this->userService = new UserService(new UserRepository(new UserModel($db)));
        $this->productService = new ProductService(new ProductRepository(new ProductModel($db)));
        $this->saleService = new SaleService(new SaleRepository(new SaleModel($db)));
    }

    public function uploadJson()
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if ($finfo->file($_FILES['data']['tmp_name']) !== 'application/json') {
            throw new RuntimeException('Invalid file format.');
        }

        $jsonData = file_get_contents($_FILES['data']['tmp_name']);
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Invalid JSON format: ' . json_last_error_msg());
        }


        foreach ($data as $item) {
            $userID = $this->userService->registerUser(
                filter_var($item['customer_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                filter_var($item['customer_mail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            );
            $this->productService->addProduct(
                filter_var($item['product_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                filter_var($item['product_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                filter_var($item['product_price'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            );
            $this->saleService->addSale(
                filter_var($item['sale_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                $userID,
                filter_var($item['product_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                filter_var($item['sale_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            );
        }

        Helper::view('src/Views/home.php');
    }

}