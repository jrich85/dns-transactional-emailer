<?php

namespace App\Jobs;

// use App\Jobs\Middleware\RateLimited;
use App\Mail\HED\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimitedWithRedis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class SendInvoiceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $to;
    private array $emailFields;
    private string $generatedPdf;
    private bool $isLate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(object $to, array $emailFields, string $generatedPdf, bool $isLate = false)
    {
        $this->to = $to;
        $this->emailFields = $emailFields;
        $this->generatedPdf = $generatedPdf;
        $this->isLate = $isLate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->to)->send(
            new Invoice($this->emailFields, $this->generatedPdf, $this->isLate)
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
