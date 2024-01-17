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
//        dd( $this->userService->checkExistEmail( 'dsf@fsd.sdf'));
//        $this->userService->registerUser('omid', 'dsf@fsd.sdf', 'sdfsdf');
        Helper::view('src/Views/home.php');
    }

    public function about()
    {
        echo 'about';
    }
}