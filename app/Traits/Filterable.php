<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;

/**
 * Trait Filterable
 * @package App\Traits
 */
trait Filterable
{
    /**
     * @param Builder $query
     * @param QueryFilter $filters
     *
     * @return Builder
     */
    public function scopeFilter(Builder $query, QueryFilter $filters): Builder
    {
        return $filters->apply($query);
    }

    /**
     * @param Builder $query
     * @param $value
     *
     * @return Builder
     */
    public function scopeFilterId(Builder $query, $value): Builder
    {
        return $query->where('id', $value);
    }

    /**
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public function scopeFilterEmail(Builder $builder, mixed $value): Builder
    {
        return $builder->where('email', 'LIKE', '%' . $value . '%');
    }

    /**
     * @param Builder $builder
     * @param $value
     *
     * @return Builder
     */
    public function scopeFilterName(Builder $builder, $value): Builder
    {
        return $builder->where('name', 'LIKE', '%' . $value . '%');
    }
}
