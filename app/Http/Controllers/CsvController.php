<?php

namespace App\Http\Controllers;

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
}
