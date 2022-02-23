<?php

namespace App\Providers;

use App\Models\{
    Account,
    User
};
use App\Observers\{
    AccountObserver,
    UserObserver
};
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Account::observe(AccountObserver::class);
        User::observe(UserObserver::class);
    }
}
