<?php

namespace App\Http\Controllers;

use App\Mail\HED\Invoice as HEDInvoice;
use App\Mail\HED\Receipt as HEDReceipt;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use NumberFormatter;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function previewInvoicePDF(/*Request $request*/): Response
    {
        $dateFormat = 'F j, Y';

        $numberFormatter = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);

        $data = [
            'fullName' => 'Joe Blow',
            'address1' => '123 Fake St.',
            'address2' => 'Apt. 75',
            'city' => 'Springfield',
            'province' => 'NS',
            'postalCode' => 'H0H 0H0',
            'invoiceDate' => date($dateFormat, strtotime('2022-01-01')),
            'invoiceNum' => 'ckz03r4u40000e3bzdz9b7rop',
            'membershipNum' => 'ckz03r4u60001e3bzb7iqdmyq',
            'subscriberNum' => 'ckz03r4u60002e3bz3h5l6yrk',
            'fiscalStartDate' => date($dateFormat, strtotime('2022-01-01')),
            'fiscalEndDate' => date($dateFormat, strtotime('2023-01-01')),
            'dueDate' => date($dateFormat, strtotime('2021-05-01')),
            'planType' => 'Super duper plan',
            'amount' => $numberFormatter->formatCurrency(100_000_000_000, 'CAD')
        ];


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('PDF.HED.invoice', $data);
        return $pdf->stream();
    }

    public function previewInvoiceEmail(bool $isLate = false)
    {
        $dateFormat = 'F j, Y';

        $data = (object)[
            'prefix' => 'Dr.',
            'lastName' => 'Blow',
            'dueDate' => date($dateFormat, strtotime('2021-05-01')),
            'membershipNum' => 'ckz03r4u60001e3bzb7iqdmyq',
        ];

        return new HEDInvoice($data, $isLate);
    }

    public function previewReceiptPDF(/*Request $request*/): Response
    {
        $dateFormat = 'F j, Y';

        $numberFormatter = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);

        $data = [
            'fullName' => 'Joe Blow',
            // 'personalIncorporation' => 'Dr. Blow Inc.',
            'personalIncorporation' => '',
            'address1' => '123 Fake St.',
            'address2' => 'Apt. 75',
            'city' => 'Springfield',
            'province' => 'NS',
            'postalCode' => 'H0H 0H0',
            'membershipNum' => 'ckz03r4u60001e3bzb7iqdmyq',
            'fiscalStartDate' => date($dateFormat, strtotime('2022-01-01')),
            'fiscalEndDate' => date($dateFormat, strtotime('2023-01-01')),
            'planType' => 'Super duper plan',
            'amount' => $numberFormatter->formatCurrency(100_000_000_000, 'CAD'),
            'dateReceived' => date($dateFormat, strtotime('2022-03-01')),
        ];


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('PDF.HED.receipt', $data);
        return $pdf->stream();
    }

    public function previewReceiptEmail()
    {
        $data = (object)[
            'prefix' => 'Dr.',
            'lastName' => 'Blow',
        ];

        return new HEDReceipt($data);
    }

}
