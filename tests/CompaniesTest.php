<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CompaniesTest extends TestCase
{
    public function testGetCompanies()
    {
        $user = \App\Models\User::query()->first() ?: $this->app->make(\App\Models\User::class);

        $token = $user->createToken(User::API_AUTH_NAME)->accessToken;

        $this->json('POST', '/api/user/companies', [])
            ->seeJson([
                'success' => false,
                'message' => 'Unauthorized.',
            ]);

        $this->json('GET', '/api/user/companies', [], ['Authorization' => "Bearer $token"])
            ->seeJson([
                'success' => true,
                'current_page' => 1
            ]);
    }

    public function testCreateCompanies()
    {
        $user = \App\Models\User::query()->first() ?: $this->app->make(\App\Models\User::class);

        $token = $user->createToken(User::API_AUTH_NAME)->accessToken;

        $company = \App\Models\Company::query()->first();

        $this->json('POST', '/api/user/companies', ['test' => 'a1'], ['Authorization' => "Bearer $token"])
            ->seeJson([
                'success' => false,
                'data' => ['The data field is required.'],
            ]);

        $this->json('POST', '/api/user/companies', [$company->toArray()], ['Authorization' => "Bearer $token"])
            ->seeJson([
                'success' => false,
                'data' => ['The data field is required.'],
            ]);
    }
}
