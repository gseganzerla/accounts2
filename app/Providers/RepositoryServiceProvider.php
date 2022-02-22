<?php

namespace App\Providers;

use App\Repositories\{
    AccountRepository
};
use App\Repositories\Contracts\{
    AccountRepositoryInterface
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AccountRepositoryInterface::class,
            AccountRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
