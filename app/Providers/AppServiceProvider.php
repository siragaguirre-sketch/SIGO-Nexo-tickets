<?php

namespace App\Providers;

use App\Contracts\Tickets\TicketWorkflowPolicyContract;
use App\Services\Tickets\TicketWorkflowPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TicketWorkflowPolicyContract::class,
            TicketWorkflowPolicy::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
