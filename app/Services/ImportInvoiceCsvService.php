<?php
namespace App\Services;

use App\Mail\HED\Invoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ImportInvoiceCsvService
{
    protected PdfGeneratorService $pdfGenerator;
    protected array $header;
    protected array $content;
    protected array $columnMap;

    public function __construct(PdfGeneratorService $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    public function setup(array $header, array $content): void
    {
        $this->header = $header;
        $this->content = $content;

        $this->mapHeaderToColumns();
    }

    public function validate()
    {
        $validator = Validator::make(
            [
                'header' => $this->header,
                'content' => $this->content
            ],
            $this->rules(),
            $this->errorMessages()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        return true;
    }

    /**
     * Loops over $this->content, generating the pdf and queuing up the emails to be sent.
     */
    public function sendEmails(): int
    {
        $emailsQueued = 0;
        foreach ($this->content as $row) {
            $emailFields = $this->extractEmailFields($row);
            $pdfFields = $this->extractPdfFields($row);

            $to = (object)[
                'email' =>$row[$this->columnMap[Columns::EMAIL]],
                'name' => $row[$this->columnMap[Columns::FULL_NAME]]
            ];

            $generatedPdf = $this->pdfGenerator->createHEDInvoice($pdfFields);

            $this->queueEmail($to, $emailFields, $generatedPdf);
            $emailsQueued++;
        }

        return $emailsQueued;
    }

    protected function queueEmail($to, $emailFields, $generatedPdf): void
    {
        Mail::to($to)
            ->send(new Invoice($emailFields, $generatedPdf));
    }

    protected function mapHeaderToColumns(): void
    {
        foreach ($this->header as $i => $column) {
            $this->columnMap[$column] = $i;
        }
    }

    protected function requiredFields(): array
    {
        return [
            Columns::MEMBERSHIP_NUMBER,
            Columns::FULL_NAME,
            Columns::PREFIX,
            Columns::LAST_NAME,
            Columns::EMAIL,
            Columns::ADDRESS1,
            Columns::CITY,
            Columns::PROVINCE,
            Columns::POSTAL_CODE,
            Columns::INVOICE_DATE,
            Columns::INVOICE_NUMBER,
            Columns::SUBSCRIBER_NUMBER,
            Columns::FISCAL_START_DATE,
            Columns::FISCAL_END_DATE,
            Columns::PLAN_TYPE,
            Columns::AMOUNT,
            Columns::DUE_DATE,
        ];
    }

    protected function expectedColumns(): array
    {
        return [
            Columns::MEMBERSHIP_NUMBER,
            Columns::FULL_NAME,
            Columns::PREFIX,
            Columns::LAST_NAME,
            Columns::EMAIL,
            Columns::ADDRESS1,
            Columns::ADDRESS2,
            Columns::CITY,
            Columns::PROVINCE,
            Columns::POSTAL_CODE,
            Columns::INCORPORATION,
            Columns::INVOICE_DATE,
            Columns::INVOICE_NUMBER,
            Columns::SUBSCRIBER_NUMBER,
            Columns::FISCAL_START_DATE,
            Columns::FISCAL_END_DATE,
            Columns::PLAN_TYPE,
            Columns::AMOUNT,
            Columns::DUE_DATE,
        ];
    }

    protected function errorMessages(): array
    {
        return [
            'header.in' => 'Headers must have all of :values'
        ];
    }

    protected function rules(): array
    {
        $columns = $this->expectedColumns();
        $rules = [
            'header' => 'required|array|size:'.count($columns).'|in:'.implode(',', $columns),
            'content' => 'required|array|min:1',
        ];
        foreach ($this->columnMap as $column => $pos) {
            $rule = 'string';
            if (in_array($column, $this->requiredFields())) {
                $rule .= '|required|min:1';
            }
            $rules["content.*.{$pos}"] = $rule;
        }

        return $rules;
    }

    protected function extractPdfFields(array $row): array
    {
        return [
            'fullName' => $row[$this->columnMap[Columns::FULL_NAME]],
            'address1' => $row[$this->columnMap[Columns::ADDRESS1]],
            'address2' => $row[$this->columnMap[Columns::ADDRESS2]] ?? '',
            'city' => $row[$this->columnMap[Columns::CITY]],
            'province' => $row[$this->columnMap[Columns::PROVINCE]],
            'postalCode' => $row[$this->columnMap[Columns::POSTAL_CODE]],
            'invoiceDate' => $row[$this->columnMap[Columns::INVOICE_DATE]],
            'invoiceNum' => $row[$this->columnMap[Columns::INVOICE_NUMBER]],
            'membershipNum' => $row[$this->columnMap[Columns::MEMBERSHIP_NUMBER]],
            'subscriberNum' => $row[$this->columnMap[Columns::SUBSCRIBER_NUMBER]],
            'fiscalStartDate' => $row[$this->columnMap[Columns::FISCAL_START_DATE]],
            'fiscalEndDate' => $row[$this->columnMap[Columns::FISCAL_END_DATE]],
            'dueDate' => $row[$this->columnMap[Columns::DUE_DATE]],
            'planType' => $row[$this->columnMap[Columns::PLAN_TYPE]],
            'amount' => $row[$this->columnMap[Columns::AMOUNT]],
        ];
    }

    protected function extractEmailFields(array $row): array
    {
        return [
            'prefix' => $row[$this->columnMap[Columns::PREFIX]],
            'lastName' => $row[$this->columnMap[Columns::LAST_NAME]],
            'dueDate' => $row[$this->columnMap[Columns::DUE_DATE]],
            'membershipNum' => $row[$this->columnMap[Columns::MEMBERSHIP_NUMBER]],
        ];
    }

}
