<?php
namespace App\Services;

use App\Repositories\UserRepository;

class EditorUserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers($userId)
    {
        return $this->userRepository->getUsers($userId);
    }
}