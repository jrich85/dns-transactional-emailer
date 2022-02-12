<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportInvoiceCsvRequest;
use App\Http\Requests\ImportReceiptCsvRequest;
use App\Services\ImportInvoiceCsvService;
use App\Services\ImportInvoiceReminderCsvService;
use App\Services\ImportReceiptCsvService;
use Illuminate\Routing\Controller as BaseController;

class CsvController extends BaseController
{
    public function promptForInvoiceCsv()
    {
        return view('pages.invoice', ['active' => route('prompt-invoices')]);
    }

    public function promptForInvoiceReminderCsv()
    {
        return view('pages.invoice-reminders', ['active' => route('prompt-invoice-reminders')]);
    }

    public function promptForReceiptCsv()
    {
        return view('pages.receipt', ['active' => route('prompt-receipts')]);
    }

    public function importInvoices(ImportInvoiceCsvRequest $request)
    {
        if ($request->input('late')) {
            /** @var ImportInvoiceReminderCsvService $importService */
            $importService = resolve(ImportInvoiceReminderCsvService::class);
            $redirect = '/invoice-reminders';
        } else {
            /** @var ImportInvoiceCsvService $importService */
            $importService = resolve(ImportInvoiceCsvService::class);
            $redirect = '/invoice';
        }

        $file = $request->file('csv_invoices');

        $rows = array_map('str_getcsv', file($file->getRealPath()));
        $header = array_shift($rows);

        $importService->setup($header, $rows);
        $valid = $importService->validate();

        if ($valid !== true) {
            return $valid;
        }

        $emailsQueued = $importService->sendEmails();

        return redirect("{$redirect}?queued={$emailsQueued}");
    }

    public function importReceipts(ImportReceiptCsvRequest $request)
    {
        /** @var ImportReceiptCsvService $importService */
        $importService = resolve(ImportReceiptCsvService::class);

        $file = $request->file('csv_receipts');

        $rows = array_map('str_getcsv', file($file->getRealPath()));
        $header = array_shift($rows);

        $importService->setup($header, $rows);
        $valid = $importService->validate();

        if ($valid !== true) {
            return $valid;
        }

        $emailsQueued = $importService->sendEmails();

        return redirect("/receipt?queued={$emailsQueued}");
    }
}
