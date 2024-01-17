<?php

namespace Service;

use Repository\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->userRepository->addUser($name, $email, $hashedPassword);
    }

    public function checkExistEmail(string $email): bool
    {
        return $this->userRepository->checkExistEmail($email);
    }
}