<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportInvoiceCsvRequest;
use App\Services\ImportInvoiceCsvService;
use Illuminate\Routing\Controller as BaseController;

class CsvController extends BaseController
{
    public function promptForInvoiceCsv()
    {
        return view('pages.invoice', ['active' => '/invoice']);
    }

    public function promptForReceiptCsv()
    {
        return view('pages.receipt', ['active' => '/receipt']);
    }

    public function importInvoices(ImportInvoiceCsvRequest $request)
    {
        $importService = resolve(ImportInvoiceCsvService::class);

        $file = $request->file('csv_invoices');

        $rows = array_map('str_getcsv', file($file->getRealPath()));
        $header = array_shift($rows);

        $importService->setup($header, $rows);
        $valid = $importService->validate();

        if ($valid !== true) {
            return $valid;
        }

        return response()->json($request->all());
    }
}
