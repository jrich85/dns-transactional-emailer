<?php

namespace App\Jobs;

use App\Mail\HED\Receipt;
use App\Services\PdfGeneratorService;
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
    private array $pdfFields;
    private string $filename;
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
        string $filename
    ) {
        $this->to = $to;
        $this->emailFields = $emailFields;
        $this->pdfFields = $pdfFields;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->pdfGenerator = resolve(PdfGeneratorService::class);
        $generatedPdf = $this->pdfGenerator->createHEDReceipt($this->pdfFields, $this->filename);

        Mail::to($this->to)->send(
            new Receipt($this->emailFields, $generatedPdf)
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
