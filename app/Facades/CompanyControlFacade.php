<?php

namespace App\Facades;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Builder[]|Collection createCompany(array $data)
 * @method static LengthAwarePaginator getCompanies()
 */
class CompanyControlFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'company_control';
    }
}
