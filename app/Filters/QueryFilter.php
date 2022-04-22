<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QueryFilter
 * @package App\Filters
 */
abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Builder|QueryBuilder
     */
    protected QueryBuilder|Builder $builder;

    /**
     * @var array
     */
    protected array $filters;

    /**
     * QueryFilter constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder|QueryBuilder $builder
     * @return Builder|QueryBuilder
     */
    public function apply(Builder|QueryBuilder $builder): Builder|QueryBuilder
    {
        $this->builder = $builder;

        $this->preFiltering();

        foreach ($this->filters() as $filter => $value) {
            $filter = str_replace('_', '', $filter);

            if (method_exists($this, $filter) && ! is_null($value)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * @param array $filters
     */
    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    /**
     * @param array $filters
     */
    public function addFilters(array $filters): void
    {
        $this->filters = array_merge($this->filters(), $filters);
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->filters ?? $this->request->all();
    }

    /**
     * @param string $filter
     * @return bool
     */
    public function existsFilter(string $filter): bool
    {
        return array_key_exists($filter, $this->filters());
    }

    /**
     * @param string $filter
     * @return mixed
     */
    public function getFilterValue(string $filter): mixed
    {
        return $this->filters()[$filter];
    }

    /**
     * @return void
     */
    protected function preFiltering(): void
    {
    }
}
