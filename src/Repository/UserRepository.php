<?php

namespace Repository;

use Model\UserModel;

class UserRepository
{
    protected $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function addUser(string $name,string $email,string $hashedPassword) {
        return $this->userModel->createUser($name, $email, $hashedPassword);
    }

    public function checkExistEmail(string $email) {
        return $this->userModel->checkExistEmail($email);
    }
}