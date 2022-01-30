<?php

namespace Tests\Unit\Services;

use App\Services\PdfGeneratorService;
use Faker\Generator;
use Illuminate\Support\Facades\Storage;
use ErrorException;
use Tests\Support\DataGenerators\InvoicePDFGenerator;
use Tests\Support\DataGenerators\ReceiptPDFGenerator;
use Tests\TestCase;

class PdfGeneratorServiceTest extends TestCase
{
    private PdfGeneratorService $pdfGenerator;
    private InvoicePDFGenerator $invoiceDataGenerator;
    private ReceiptPDFGenerator $receiptDataGenerator;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        $this->pdfGenerator = resolve(PdfGeneratorService::class);
        $this->invoiceDataGenerator = resolve(InvoicePDFGenerator::class);
        $this->receiptDataGenerator = resolve(ReceiptDataGenerator::class);
    }

    /** @test */
    public function createHEDInvoiceErrorsWithoutRequiredFields(): void
    {
        $data = $this->invoiceDataGenerator->generate();

        foreach ($this->invoiceDataGenerator->requiredFields() as $field) {
            $dataPassedIn = $data;
            unset($dataPassedIn[$field]);

            try {
                $this->pdfGenerator->createHEDInvoice($dataPassedIn);
            } catch(ErrorException $e) {
                static::assertSame('Undefined array key "'.$field.'"', $e->getMessage());
            }
        }
    }

    /** @test */
    public function createHEDInvoiceGeneratesFile(): void
    {
        $file = $this->pdfGenerator->createHEDInvoice($this->invoiceDataGenerator->generate());

        Storage::disk('local')->assertExists($file);
    }

    /** @test */
    public function createHEDReceiptErrorsWithoutRequiredFields(): void
    {
        $data = $this->receiptDataGenerator->generate();

        foreach ($this->receiptDataGenerator->requiredFields() as $field) {
            $dataPassedIn = $data;
            unset($dataPassedIn[$field]);

            try {
                $this->pdfGenerator->createHEDReceipt($dataPassedIn);
            } catch(ErrorException $e) {
                static::assertSame('Undefined array key "'.$field.'"', $e->getMessage());
            }
        }
    }

    /** @test */
    public function createHEDReceiptGeneratesFile(): void
    {
        $file = $this->pdfGenerator->createHEDReceipt($this->receiptDataGenerator->generate());

        Storage::disk('local')->assertExists($file);
    }
}
