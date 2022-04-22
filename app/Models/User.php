<?php

declare(strict_types=1);

namespace App\Models;

use App\Filters\UsersFilter;
use App\Traits\Filterable;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class)
            ->withPivot('grade');
    }

    /**
     * @param Builder $builder
     * @return Builder|QueryBuilder
     */
    public function scopeFilter(Builder $builder): Builder|QueryBuilder
    {
        return (new UsersFilter(request()))->apply($builder);
    }
}
