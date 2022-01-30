<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class PdfGeneratorService
{
    /**
     * Creates a Health and Dental invoice and returns the resulting filename.
     */
    public function createHEDInvoice(array $info): string
    {
        $data = [
            'fullName' => $info['fullName'],
            'address1' => $info['address1'],
            'address2' => $info['address2'],
            'city' => $info['city'],
            'province' => $info['province'],
            'postalCode' => $info['postalCode'],
            'invoiceDate' => $info['invoiceDate'],
            'invoiceNum' => $info['invoiceNum'],
            'membershipNum' => $info['membershipNum'],
            'subscriberNum' => $info['subscriberNum'],
            'fiscalStartDate' => $info['fiscalStartDate'],
            'fiscalEndDate' => $info['fiscalEndDate'],
            'dueDate' => $info['dueDate'],
            'planType' => $info['planType'],
            'amount' => $info['amount']
        ];

        if (!Storage::exists('test/invoices')) {
            Storage::disk('local')->makeDirectory('test/invoices');
        }

        $filename = "test/invoices/HED-invoice-{$info['invoiceNum']}.pdf";

        $pdf = App::make('dompdf.wrapper');
        $result = $pdf->loadView('PDF.HED.invoice', $data)->output();

        Storage::disk('local')->put($filename, $result);

        return $filename;
    }

    /**
     * Creates a Health and Dental invoice and returns the resulting filename.
     */
    public function createHEDReceipt(array $info): string
    {
        $data = [
            'fullName' => $info['fullName'],
            'personalIncorporation' => $info['personalIncorporation'] ?? '',
            'address1' => $info['address1'],
            'address2' => $info['address2'],
            'city' => $info['city'],
            'province' => $info['province'],
            'postalCode' => $info['postalCode'],
            'membershipNum' => $info['membershipNum'],
            'fiscalStartDate' => $info['fiscalStartDate'],
            'fiscalEndDate' => $info['fiscalEndDate'],
            'dateReceived' => $info['dateReceived'],
            'planType' => $info['planType'],
            'amount' => $info['amount']
        ];

        if (!Storage::exists('test/receipts')) {
            Storage::disk('local')->makeDirectory('test/receipts');
        }

        $filename = "test/receipts/HED-receipt-{$info['membershipNum']}-{$info['dateReceived']}.pdf";

        $pdf = App::make('dompdf.wrapper');
        $result = $pdf->loadView('PDF.HED.receipt', $data)->output();

        Storage::disk('local')->put($filename, $result);

        return $filename;
    }
}
