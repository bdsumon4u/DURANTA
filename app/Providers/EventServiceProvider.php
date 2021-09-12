<?php

namespace App\Providers;

use App\Listeners\CopyFaviconConversion;
use App\Listeners\SendPhoneVerificationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Spatie\MediaLibrary\Conversions\Events\ConversionHasBeenCompleted;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendPhoneVerificationNotification::class,
        ],
        ConversionHasBeenCompleted::class => [
            CopyFaviconConversion::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
