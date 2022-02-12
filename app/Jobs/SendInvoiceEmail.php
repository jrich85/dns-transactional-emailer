<?php

namespace App\Jobs;

// use App\Jobs\Middleware\RateLimited;
use App\Mail\HED\Invoice;
use App\Services\PdfGeneratorService;
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
    private array $pdfFields;
    private string $filename;
    private bool $isLate;
    private PdfGeneratorService $pdfGenerator;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        object $to,
        array $emailFields,
        array $pdfFields,
        string $filename,
        bool $isLate = false
    ) {
        $this->to = $to;
        $this->emailFields = $emailFields;
        $this->pdfFields = $pdfFields;
        $this->filename = $filename;
        $this->isLate = $isLate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->pdfGenerator = resolve(PdfGeneratorService::class);
        $generatedPdf = $this->pdfGenerator->createHEDInvoice($this->pdfFields, $this->filename);

        Mail::to($this->to)->send(
            new Invoice($this->emailFields, $generatedPdf, $this->isLate)
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
