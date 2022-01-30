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

class PreviewController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private PdfGeneratorService $pdfGenerator;

    public function __construct(PdfGeneratorService $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    public function previewInvoicePDF()
    {
        $data = [
            'fullName' => 'FULL NAME',
            'address1' => 'ADDRESS 1',
            'address2' => 'ADDRESS 2',
            'city' => 'CITY',
            'province' => 'PROVINCE',
            'postalCode' => 'POSTAL CODE',
            'invoiceDate' => 'INVOICE DATE',
            'invoiceNum' => 'INVOICE NUMBER',
            'membershipNum' => 'MEMBER NUMBER',
            'subscriberNum' => 'SUBSCRIBER NUMBER',
            'fiscalStartDate' => 'FISCAL START DATE',
            'fiscalEndDate' => 'FISCAL END DATE',
            'dueDate' => 'DUE DATE',
            'planType' => 'PLAN TYPE',
            'amount' => 'AMOUNT'
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
        $data = [
            'prefix' => 'PREFIX',
            'lastName' => 'LAST NAME',
            'dueDate' => 'DUE DATE',
            'membershipNum' => 'MEMBER NUMBER',
            'fullName' => 'FULL NAME',
            'address1' => 'ADDRESS 1',
            'address2' => 'ADDRESS 2',
            'city' => 'CITY',
            'province' => 'PROVINCE',
            'postalCode' => 'POSTAL CODE',
            'invoiceDate' => 'INVOICE DATE',
            'invoiceNum' => 'INVOICE NUMBER',
            'subscriberNum' => 'SUBSCRIBER NUMBER',
            'fiscalStartDate' => 'FISCAL START DATE',
            'fiscalEndDate' => 'FISCAL END DATE',
            'planType' => 'PLAN TYPE',
            'amount' => 'AMOUNT',
            'preview' => true,
        ];

        $filename = $this->pdfGenerator->createHEDInvoice($data);

        $content = (new HEDInvoice($data, $filename, $isLate))->build();

        return view('pages.previews.email.HED.invoice', [
            'active' => '/preview/email/invoice',
            'content' => $content
        ]);
    }

    public function previewReceiptPDF()
    {
        $dateFormat = 'F j, Y';

        $numberFormatter = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);

        $data = [
            'fullName' => 'FULL NAME',
            'personalIncorporation' => 'PERSONAL INCORPORATION',
            'address1' => 'ADDRESS 1',
            'address2' => 'ADDRESS 2',
            'city' => 'CITY',
            'province' => 'PROVINCE',
            'postalCode' => 'POSTAL CODE',
            'membershipNum' => 'MEMBER NUMBER',
            'fiscalStartDate' => 'FISCAL START DATE',
            'fiscalEndDate' => 'FISCAL END DATE',
            'planType' => 'PLAN TYPE',
            'amount' => 'AMOUNT',
            'dateReceived' => 'DATE RECEIVED',
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
        $data = [
            'prefix' => 'PREFIX',
            'lastName' => 'LAST NAME',
            'fullName' => 'FULL NAME',
            'personalIncorporation' => 'PERSONAL INCORPORATION',
            'address1' => 'ADDRESS 1',
            'address2' => 'ADDRESS 2',
            'city' => 'CITY',
            'province' => 'PROVINCE',
            'postalCode' => 'POSTAL CODE',
            'membershipNum' => 'MEMBER NUMBER',
            'fiscalStartDate' => 'FISCAL START DATE',
            'fiscalEndDate' => 'FISCAL END DATE',
            'planType' => 'PLAN TYPE',
            'amount' => 'AMOUNT',
            'dateReceived' => 'DATE RECEIVED',
            'preview' => true,
        ];

        $filename = $this->pdfGenerator->createHEDReceipt($data);

        $content = (new HEDReceipt($data, $filename))->build();

        return view('pages.previews.email.HED.receipt', [
            'active' => '/preview/email/receipt',
            'content' => $content
        ]);

    }

}
