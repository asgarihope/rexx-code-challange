<?php

use Helper\Helper;
use Model\UserModel;
use Repository\UserRepository;
use Service\UserService;

class HomeController
{

    private $db;
    /**
     * @var \Service\UserService
     */
    private $userService;

    public function __construct(mysqli $db)
    {
        $model = new UserModel($db);
        $repository = new UserRepository($model);
        $this->userService = new UserService($repository);
    }

    public function index()
    {
        Helper::view('src/Views/home.php','Omid Asgari Project');
    }

    public function about()
    {
        Helper::view('src/Views/about.php','About');
    }
}