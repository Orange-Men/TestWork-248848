<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UserRepository
 * @package App\Repository\Eloquent
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @return LengthAwarePaginator
     */
    public function getAllUsers(): LengthAwarePaginator
    {
        return User::query()
            ->with('exams')
            ->filter()
            ->paginate();
    }
}
