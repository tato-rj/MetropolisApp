<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\{EventCreated, EventUpdated, EventCanceled, MembershipCreated, BillCreated, WorkshopSignup};
use App\Listeners\Bills\SendBillingEmail;
use App\Listeners\Workshops\SendConfirmationEmail as SendWorkshopConfirmationEmail;
use App\Listeners\Events\{SendInvitationEmail, SendUpdateEmail};
use App\Listeners\Events\SendConfirmationEmail as SendEventConfirmationEmail;
use App\Listeners\Memberships\SendConfirmationEmail as SendMembershipConfirmationEmail;
use App\Listeners\Memberships\CancelMembership;

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
        ],
        EventCreated::class => [
            SendEventConfirmationEmail::class,
            SendInvitationEmail::class
        ],
        EventUpdated::class => [
            SendUpdateEmail::class
        ],
        EventCanceled::class => [
            CancelMembership::class
        ],
        BillCreated::class => [
            SendBillingEmail::class
        ],
        MembershipCreated::class => [
            SendMembershipConfirmationEmail::class
        ],
        WorkshopSignup::class => [
            SendWorkshopConfirmationEmail::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
