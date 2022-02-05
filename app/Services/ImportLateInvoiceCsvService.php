<?php

namespace App\Services;

use App\Mail\HED\Invoice;
use Illuminate\Support\Facades\Mail;

class ImportLateInvoiceCsvService extends ImportInvoiceCsvService
{
    protected function queueEmail($to, $emailFields, $generatedPdf): void
    {
        Mail::to($to)
            ->queue(new Invoice($emailFields, $generatedPdf, true));
    }

}
