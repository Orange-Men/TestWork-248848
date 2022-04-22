<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers();
    }
}
