<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PdfGeneratorService
{
    /**
     * Creates a Health and Dental invoice and returns the resulting filename.
     *
     * @param string[] $info Information to be placed into the invoice template
     * @param string $filename Desired filename for generated file. If missing the .pdf extension, it's added.
     * @return string Resulting full-path filename.
     */
    public function createHEDInvoice(array $info, string $filename): string
    {
        if (!Str::endsWith($filename, '.pdf')) {
            $filename .= '.pdf';
        }

        $data = [
            'fullName' => $info['fullName'],
            'address1' => $info['address1'],
            'address2' => $info['address2'] ?? '',
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

        $fullPathFilename = "PDF/invoices/{$filename}";

        $pdf = App::make('dompdf.wrapper');
        $result = $pdf->loadView('PDF.HED.invoice', $data)->output();

        Storage::disk('local')->put($fullPathFilename, $result);

        return $fullPathFilename;
    }

    /**
     * Creates a Health and Dental invoice and returns the resulting filename.
     *
     * @param string[] $info Information to be placed into the receipt template
     * @param string $filename Desired filename for generated file. If missing the .pdf extension, it's added.
     * @return string Resulting full-path filename.
     */
    public function createHEDReceipt(array $info, string $filename): string
    {
        if (!Str::endsWith($filename, '.pdf')) {
            $filename .= '.pdf';
        }

        $data = [
            'fullName' => $info['fullName'],
            'personalIncorporation' => $info['personalIncorporation'] ?? '',
            'address1' => $info['address1'],
            'address2' => $info['address2'] ?? '',
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

        $fullPathFilename = "PDF/receipts/{$filename}";

        $pdf = App::make('dompdf.wrapper');
        $result = $pdf->loadView('PDF.HED.receipt', $data)->output();

        Storage::disk('local')->put($fullPathFilename, $result);

        return $fullPathFilename;
    }
}
