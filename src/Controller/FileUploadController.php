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
        $jsonData = file_get_contents($_FILES['data']['tmp_name']);
        $data = json_decode($jsonData, true);

        $data = json_decode($jsonData, true);
        foreach ($data as $item) {
            $userID = $this->userService->registerUser(
                $item['customer_name'],
                $item['customer_mail']
            );
            $this->productService->addProduct(
                $item['product_id'],
                $item['product_name'],
                $item['product_price']
            );
            $this->saleService->addSale(
                $item['sale_id'],
                $userID,
                $item['product_id'],
                $item['sale_date']
            );
        }
//        $this->productService->addProduct()
//        dd( $this->userService->checkExistEmail( 'dsf@fsd.sdf'));
//        $this->userService->registerUser('omid', 'dsf@fsd.sdf', 'sdfsdf');
        Helper::view('src/Views/home.php');
    }

    public function about()
    {
        echo 'about';
    }
}