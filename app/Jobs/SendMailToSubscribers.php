<?php

namespace App\Jobs;

use App\Models\Subscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\mail\SubMail;
use Illuminate\Support\Facades\Mail;
class SendMailToSubscribers implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $suscribers = Subscriber::all();
        foreach ($suscribers as $subscriber) {
            // Send email to each subscriber
            Mail::to($subscriber->email)->queue(new SubMail($subscriber->email));
        }
    }
}
