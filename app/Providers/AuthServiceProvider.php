<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Notifications\Admin\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Notification;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
//        Notification::send(function () {
//            return new VerifyEma;
//        });
    }
}
