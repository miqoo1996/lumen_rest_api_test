<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    public function testLogin()
    {
        $user = \App\Models\User::query()->first() ?: $this->app->make(\App\Models\User::class);

        $this->json('POST', '/api/user/login', ['email' => null])
            ->seeJson([
                'success' => false,
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);

        $this->json('POST', '/api/user/login', ['email' => $user->email, 'password' => '111111'])
            ->seeJson([
                'success' => true,
            ]);
    }

    public function testRegister()
    {
        $user = \App\Models\User::query()->first() ?: $this->app->make(\App\Models\User::class);

        $this->json('POST', '/api/user/login', ['email' => null, 'password' => '111111'])
            ->seeJson([
                'success' => false,
                'email' => ['The email field is required.']
            ]);

        $this->json('POST', '/api/user/login', array_merge($user->toArray(), ['password' => '111111']))
            ->seeJson([
                'success' => true,
            ]);
    }

    public function testRecoveryEmailToken()
    {
        $user = \App\Models\User::query()->skip(2)->first() ?: $this->app->make(\App\Models\User::class);

        $this->json('POST', '/api/user/recover-password', [])
            ->seeJson([
                'success' => false,
                'email' => ['The email field is required.']
            ]);

        $this->json('POST', '/api/user/recover-password', ['email' => $user->email])
            ->seeJson([
                'success' => true,
            ]);

        $user->refresh();

        $this->json('PATCH', '/api/user/recover-password', ['email_token' => $user->email_token, 'password' => "111111"])
            ->seeJson([
                'success' => true,
            ]);
    }
}
