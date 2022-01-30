<?php

namespace App\Http\Controllers;

use App\Mail\HED\Invoice as HEDInvoice;
use App\Mail\HED\Receipt as HEDReceipt;
use App\Services\PdfGeneratorService;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private PdfGeneratorService $pdfGenerator;

    public function __construct(PdfGeneratorService $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    public function previewInvoicePDF()
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

        $filename = $this->pdfGenerator->createHEDInvoice($data);

        return Response::make(
            Storage::get($filename),
            200,
            [
                'Content-type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="example-invoice.pdf"'
            ]);
    }

    public function previewInvoiceEmail(bool $isLate = false)
    {
        $dateFormat = 'F j, Y';

        $numberFormatter = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);

        $data = [
            'prefix' => 'Dr.',
            'lastName' => 'Blow',
            'dueDate' => date($dateFormat, strtotime('2021-05-01')),
            'membershipNum' => 'ckz03r4u60001e3bzb7iqdmyq',
            'fullName' => 'Joe Blow',
            'address1' => '123 Fake St.',
            'address2' => 'Apt. 75',
            'city' => 'Springfield',
            'province' => 'NS',
            'postalCode' => 'H0H 0H0',
            'invoiceDate' => date($dateFormat, strtotime('2022-01-01')),
            'invoiceNum' => 'ckz03r4u40000e3bzdz9b7rop',
            'subscriberNum' => 'ckz03r4u60002e3bz3h5l6yrk',
            'fiscalStartDate' => date($dateFormat, strtotime('2022-01-01')),
            'fiscalEndDate' => date($dateFormat, strtotime('2023-01-01')),
            'planType' => 'Super duper plan',
            'amount' => $numberFormatter->formatCurrency(100_000_000_000, 'CAD')
        ];

        $filename = $this->pdfGenerator->createHEDInvoice($data);

        return new HEDInvoice($data, $filename, $isLate);
    }

    public function previewReceiptPDF()
    {
        $dateFormat = 'F j, Y';

        $numberFormatter = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);

        $data = [
            'fullName' => 'Joe Blow',
            'personalIncorporation' => 'Dr. Blow Inc.',
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

        $filename = $this->pdfGenerator->createHEDReceipt($data);

        return Response::make(
            Storage::get($filename),
            200,
            [
                'Content-type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="example-receipt.pdf"'
            ]);
    }

    public function previewReceiptEmail()
    {
        $dateFormat = 'F j, Y';

        $numberFormatter = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);

        $data = [
            'prefix' => 'Dr.',
            'lastName' => 'Blow',
            'fullName' => 'Joe Blow',
            'personalIncorporation' => 'Dr. Blow Inc.',
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

        $filename = $this->pdfGenerator->createHEDReceipt($data);

        return new HEDReceipt($data, $filename);
    }

}
