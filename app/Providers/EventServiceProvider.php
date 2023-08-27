<?php

namespace App\Providers;

use App\Events\EditPasswordSubmitEvent;
use App\Events\EditProfileSubmitEvent;
use App\Events\ForgotPasswordSubmitEvent;
use App\Events\LoginSubmitDeniedEvent;
use App\Events\OrderConfirmedEvent;
use App\Events\RegisterConfirmationEvent;
use App\Events\RegisterVerifyEvent;
use App\Events\ResentLinkSubmitEvent;
use App\Events\ResetPasswordConfirmationEvent;
use App\Listeners\EditPasswordSubmitListener;
use App\Listeners\EditProfileSubmitListener;
use App\Listeners\ForgotPasswordSubmitListener;
use App\Listeners\LoginSubmitDeniedListener;
use App\Listeners\OrderConfirmedListener;
use App\Listeners\RegisterConfirmationListener;
use App\Listeners\RegisterVerifyListener;
use App\Listeners\ResentLinkSubmitListener;
use App\Listeners\ResetPasswordConfirmationListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],

        // Mapping de nos classes event et listener

        LoginSubmitDeniedEvent::class => [
            LoginSubmitDeniedListener::class,
        ],

        RegisterVerifyEvent::class => [
            RegisterVerifyListener::class,
        ],

        RegisterConfirmationEvent::class => [
            RegisterConfirmationListener::class,
        ],

        ForgotPasswordSubmitEvent::class => [
            ForgotPasswordSubmitListener::class,
        ],

        ResetPasswordConfirmationEvent::class => [
            ResetPasswordConfirmationListener::class,
        ],

        ResentLinkSubmitEvent::class => [
            ResentLinkSubmitListener::class,
        ],

        EditPasswordSubmitEvent::class => [
            EditPasswordSubmitListener::class,
        ],

        EditProfileSubmitEvent::class => [
            EditProfileSubmitListener::class,
        ],

        OrderConfirmedEvent::class => [
            OrderConfirmedListener::class,
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
