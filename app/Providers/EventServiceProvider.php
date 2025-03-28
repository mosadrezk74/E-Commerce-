<?php

namespace App\Providers;

use App\Events\PurchaseCompleted;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PurchaseCompleted::class => [
            OrderPlacedNotification::class,
        ],
    ];



    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
