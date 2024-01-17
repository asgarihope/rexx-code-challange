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

    public function registerUser($name, $email): int
    {
        if ($userID=$this->checkExistEmail($email)) {
            return $userID;
        }
        return $this->userRepository->addUser($name, $email);
    }

    public function checkExistEmail(string $email): ?int
    {
        return $this->userRepository->checkExistEmail($email);
    }
}