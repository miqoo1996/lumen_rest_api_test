<?php

namespace App\Providers;

use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\CompanyService;
use App\Services\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('user_control',function() {
            return new UserService(App::make(UserRepository::class));
        });

        $this->app->bind('company_control',function() {
            return new CompanyService(App::make(CompanyRepository::class));
        });
    }

}
