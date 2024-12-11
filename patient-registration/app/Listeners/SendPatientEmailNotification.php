<?php

namespace App\Listeners;

use App\Events\PatientRegistered;
use App\Notifications\PatientRegisteredEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPatientEmailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PatientRegistered $event): void
    {
        $event->patient->notify(new PatientRegisteredEmailNotification($event->patient));
    }
}
