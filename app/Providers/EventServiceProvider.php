<?php

namespace App\Providers;

use App\Events\EditPasswordSubmitEvent;
use App\Events\EditProfileSubmitEvent;
use App\Events\ForgotPasswordSubmitEvent;
use App\Events\LoginSubmitDeniedEvent;
use App\Events\OrderCanceledEvent;
use App\Events\OrderCompletedEvent;
use App\Events\OrderConfirmedEvent;
use App\Events\OrderFailedRefundedEvent;
use App\Events\OrderPendingEvent;
use App\Events\OrderPickedUpEvent;
use App\Events\OrderPickupFailEvent;
use App\Events\RegisterConfirmationEvent;
use App\Events\RegisterVerifyEvent;
use App\Events\ResentLinkSubmitEvent;
use App\Events\ResetPasswordConfirmationEvent;
use App\Events\ReviewCensoredEvent;
use App\Events\ReviewModeratedEvent;
use App\Events\ReviewPublishedEvent;
use App\Listeners\EditPasswordSubmitListener;
use App\Listeners\EditProfileSubmitListener;
use App\Listeners\ForgotPasswordSubmitListener;
use App\Listeners\LoginSubmitDeniedListener;
use App\Listeners\OrderCanceledListener;
use App\Listeners\OrderCompletedListener;
use App\Listeners\OrderConfirmedListener;
use App\Listeners\OrderFailedRefundedListener;
use App\Listeners\OrderPendingListener;
use App\Listeners\OrderPickedUpListener;
use App\Listeners\OrderPickupFailListener;
use App\Listeners\RegisterConfirmationListener;
use App\Listeners\RegisterVerifyListener;
use App\Listeners\ResentLinkSubmitListener;
use App\Listeners\ResetPasswordConfirmationListener;
use App\Listeners\ReviewCensoredListenerEvent;
use App\Listeners\ReviewModeratedListenerEvent;
use App\Listeners\ReviewPublishedListenerEvent;
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

        OrderPendingEvent::class => [
            OrderPendingListener::class,
        ],

        OrderCanceledEvent::class => [
            OrderCanceledListener::class,
        ],

        OrderCompletedEvent::class => [
            OrderCompletedListener::class,
        ],

        OrderPickupFailEvent::class => [
            OrderPickupFailListener::class,
        ],

        OrderPickedUpEvent::class => [
            OrderPickedUpListener::class,
        ],

        ReviewPublishedEvent::class => [
            ReviewPublishedListenerEvent::class,
        ],

        ReviewCensoredEvent::class => [
            ReviewCensoredListenerEvent::class,
        ],

        OrderFailedRefundedEvent::class=>[
            OrderFailedRefundedListener::class,
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
