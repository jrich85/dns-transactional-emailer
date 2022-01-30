<?php

namespace Tests\Unit\Services;

use App\Services\PdfGeneratorService;
use EndyJasmi\Cuid;
use Faker\Generator;
use Illuminate\Support\Facades\Storage;
use ErrorException;
use Tests\TestCase;

class PdfGeneratorServiceTest extends TestCase
{
    private PdfGeneratorService $pdfGenerator;
    private Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        $this->pdfGenerator = resolve(PdfGeneratorService::class);
        $this->faker = resolve(Generator::class);
    }

    /** @test */
    public function createHEDInvoiceErrorsWithoutRequiredFields(): void
    {
        $data = $this->getInvoicePDFData();

        foreach ($this->getInvoiceRequiredFields() as $field) {
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
        $file = $this->pdfGenerator->createHEDInvoice($this->getInvoicePDFData());

        Storage::disk('local')->assertExists($file);
    }

    /** @test */
    public function createHEDReceiptErrorsWithoutRequiredFields(): void
    {
        $data = $this->getReceiptPDFData();

        foreach ($this->getReceiptRequiredFields() as $field) {
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
        $file = $this->pdfGenerator->createHEDReceipt($this->getReceiptPDFData());

        Storage::disk('local')->assertExists($file);
    }

    private function getInvoiceRequiredFields(): array
    {
        return [
            'fullName',
            'address1',
            'city',
            'province',
            'postalCode',
            'invoiceDate',
            'invoiceNum',
            'membershipNum',
            'subscriberNum',
            'fiscalStartDate',
            'fiscalEndDate',
            'dueDate',
            'planType',
            'amount'
        ];
    }

    private function getInvoicePDFData(): array
    {
        $dateFormat = 'F j, Y';

        $data = [
            'fullName' => $this->faker->name(),
            'address1' => $this->faker->address(),
            'address2' => '',
            'city' => $this->faker->city(),
            'province' => strtoupper($this->faker->randomLetter().$this->faker->randomLetter()),
            'postalCode' => $this->faker->postcode(),
            'invoiceDate' => $this->faker->date($dateFormat),
            'invoiceNum' => Cuid::cuid(),
            'membershipNum' => Cuid::cuid(),
            'subscriberNum' => Cuid::cuid(),
            'fiscalStartDate' => $this->faker->date($dateFormat),
            'fiscalEndDate' => $this->faker->date($dateFormat),
            'dueDate' => $this->faker->date($dateFormat),
            'planType' => $this->faker->sentence(3),
            'amount' => $this->faker->numberBetween(100, 2000)
        ];

        return $data;
    }

    private function getReceiptRequiredFields(): array
    {
        return [
            'fullName',
            'address1',
            'city',
            'province',
            'postalCode',
            'membershipNum',
            'fiscalStartDate',
            'fiscalEndDate',
            'dateReceived',
            'planType',
            'amount'
        ];
    }

    private function getReceiptPDFData(): array
    {
        $dateFormat = 'F j, Y';

        $data = [
            'fullName' => $this->faker->name(),
            'personalIncorporation' => $this->faker->company(),
            'address1' => $this->faker->address(),
            'address2' => '',
            'city' => $this->faker->city(),
            'province' => strtoupper($this->faker->randomLetter().$this->faker->randomLetter()),
            'postalCode' => $this->faker->postcode(),
            'membershipNum' => Cuid::cuid(),
            'fiscalStartDate' => $this->faker->date($dateFormat),
            'fiscalEndDate' => $this->faker->date($dateFormat),
            'dateReceived' => $this->faker->date($dateFormat),
            'planType' => $this->faker->sentence(3),
            'amount' => $this->faker->numberBetween(100, 2000)
        ];

        return $data;
    }
}
