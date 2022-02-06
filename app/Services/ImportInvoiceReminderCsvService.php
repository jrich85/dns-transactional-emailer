<?php

namespace App\Services;

use App\Jobs\SendInvoiceEmail;

class ImportInvoiceReminderCsvService extends ImportInvoiceCsvService
{
    protected function dispatchEmail($to, $emailFields, $generatedPdf): void
    {
        SendInvoiceEmail::dispatch($to, $emailFields, $generatedPdf, true);
    }
}
