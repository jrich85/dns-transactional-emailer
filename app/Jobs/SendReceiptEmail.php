<?php

namespace App\Jobs;

use App\Mail\HED\Receipt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimitedWithRedis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReceiptEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $to;
    private array $emailFields;
    private string $generatedPdf;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(object $to, array $emailFields, string $generatedPdf)
    {
        $this->to = $to;
        $this->emailFields = $emailFields;
        $this->generatedPdf = $generatedPdf;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->to)->send(
            new Receipt($this->emailFields, $this->generatedPdf)
        );
    }

    public function retryUntil()
    {
        return now()->addDays(2);
    }

    public function middleware()
    {
        return [new RateLimitedWithRedis('emails')];
    }
}
