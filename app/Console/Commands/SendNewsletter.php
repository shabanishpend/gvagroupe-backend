<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Models\NewsletterEmail;
use App\Mail\Newsletter;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $subscribers = NewsletterEmail::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new Newsletter());
        }
    }
}
