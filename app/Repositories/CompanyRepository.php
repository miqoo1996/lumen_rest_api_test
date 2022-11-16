<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository
{
    /**
     * @var Company
     */
    private Company $company;

    /**
     * @param Company $user
     */
    public function __construct(Company $user)
    {
        $this->company = $user;
    }

    /**
     * @param array $data
     * @return Builder[]|Collection
     */
    public function create(array $data)
    {
        $companyIds = [];
        foreach ($data['data'] as $datum) {
            $company = $this->company->create($datum);
            $company->users()->sync($datum['user_ids']);
            $companyIds[] = $company->id;
        }
        return $this->companiesWithUsers($companyIds);
    }

    /**
     * @param array $companyIds
     * @return Builder[]|Collection
     */
    public function companiesWithUsers(array $companyIds)
    {
        return $this->company->query()->whereIn('id', $companyIds)->with('users')->get();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function companies():LengthAwarePaginator
    {
        return $this->company->query()->with('users')->paginate(20);
    }
}
