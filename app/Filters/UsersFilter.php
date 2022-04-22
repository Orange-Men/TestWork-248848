<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class UsersFilter
 * @package App\Filters
 */
class UsersFilter extends QueryFilter
{
    /**
     * @param mixed $value
     * @return void
     */
    public function search(mixed $value): void
    {
        $this->builder->where(function (Builder $builder) use ($value) {
            $builder->orWhere(fn (Builder $builder) => $builder->filterEmail($value));

            $builder->orWhere(fn (Builder $builder) => $builder->filterName($value));
        });
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function gradeMore(mixed $value): void
    {
        $this->builder->where(function (Builder $builder) use ($value) {
            $builder->whereHas(
                'exams',
                fn (Builder $builder) =>
                $builder->where('exam_user.grade', '>', $value)
            );
        });
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function gradeLess(mixed $value): void
    {
        $this->builder->where(function (Builder $builder) use ($value) {
            $builder->whereHas(
                'exams',
                fn (Builder $builder) =>
                $builder->where('exam_user.grade', '<', $value)
            );
        });
    }

    /**
     * @param $value
     */
    public function sortName($value): void
    {
        $this->builder->orderBy('name', $value);
    }

    /**
     * @param $value
     */
    public function sortEmail($value): void
    {
        $this->builder->orderBy('email', $value);
    }
}
