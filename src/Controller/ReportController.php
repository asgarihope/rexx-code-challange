<?php

use core\Config;
use Helper\Helper;
use Model\SaleModel;
use Repository\SaleRepository;
use Service\SaleService;

class ReportController
{


    /**
     * @var SaleService
     */
    private $saleService;

    public function __construct(mysqli $db)
    {
        $this->saleService = new SaleService(new SaleRepository(new SaleModel($db)));
    }

    public function report()
    {
        $data = [
            'data' => [],
            'error' => '',
            'total_price' => 0,
            'total_pages' => 0,
        ];

        if (!empty($_GET)) {
            if (empty($_GET['start_date']) || empty($_GET['end_date'])) {
                $data['error'] = 'Please select a period for showing the report';
            } else {
                $data = $this->saleService->filter(
                    $_GET['start_date'] ?? date('Y-m-d'),
                    $_GET['end_date'],
                    $_GET['user_name'] ?? null,
                    $_GET['user_email'] ?? null,
                    $_GET['product_name'] ?? null,
                    Config::DEFAULT_LIMIT_REPORT,
                    $_GET['page'] ?? 1
                );
            }
        }

        Helper::view('src/Views/report.php', 'Report', [
            'data' => $data,
            'total_price' => $data['total_price']
        ]);
    }

}