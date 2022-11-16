<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->first();

        $companies = Company::query()->take(3)->offset(0)->get();

        $this->assignCompaniesToUser($user, $companies);

        $user = User::query()->skip(1)->first();

        $companies = Company::query()->take(10)->offset(3)->get();

        $this->assignCompaniesToUser($user, $companies);
    }

    /**
     * @param User $user
     * @param Collection $companies
     * @return void
     */
    public function assignCompaniesToUser(User $user, Collection $companies)
    {
        foreach ($companies as $company) {
            UserCompany::query()->create([
                'user_id' => $user->id,
                'company_id' => $company->id,
            ]);
        }
    }
}
