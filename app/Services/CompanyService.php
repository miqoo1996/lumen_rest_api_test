<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class CompanyService
{
    /**
     * @var CompanyRepository
     */
    private CompanyRepository $companyRepository;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param array $data
     * @return Builder[]|Collection
     */
    public function createCompany(array $data)
    {
        return $this->companyRepository->create($data);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getCompanies(): LengthAwarePaginator
    {
        return $this->companyRepository->companies();
    }
}
