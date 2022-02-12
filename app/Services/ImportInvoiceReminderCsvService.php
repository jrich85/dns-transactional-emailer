<?php

namespace App\Services;

use App\Jobs\SendInvoiceEmail;

class ImportInvoiceReminderCsvService extends ImportInvoiceCsvService
{
    protected function dispatchEmail($to, $emailFields, $pdfFields, $filename): void
    {
        SendInvoiceEmail::dispatch($to, $emailFields, $pdfFields, $filename, true);
    }
}
