<?php

namespace Repository;

use Model\UserModel;

class UserRepository
{
    protected $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function addUser(string $name,string $email) {
        return $this->userModel->createUser($name, $email);
    }

    public function checkExistEmail(string $email) :?int{
        return $this->userModel->checkExistEmail($email);
    }
}