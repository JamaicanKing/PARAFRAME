<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use App\Models\Audit;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;

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
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(function (Login $event) {
            $audit = Audit::create([
                'user_id' => Auth::user()->id,
                'log_type' => 'LOGIN'
            ]);
        });

        Event::listen(function (Logout $event) {
            $audit = Audit::create([
                'user_id' => Auth::user()->id,
                'log_type' => 'LOGOUT'
            ]);
        });
    }
}
