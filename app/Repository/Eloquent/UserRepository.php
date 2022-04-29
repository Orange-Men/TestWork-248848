<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class UserRepository
 * @package App\Repository\Eloquent
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @param Request $request
     * @return Model
     */
    public function create(Request $request): Model
    {
        return User::query()
            ->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'api_token' => Str::random(60),
            ]);
    }

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
