<?php

namespace Tests\Unit\Mail\HED;

use App\Mail\HED\Invoice;
use ErrorException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\Support\DataGenerators\InvoiceEmailGenerator;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    private InvoiceEmailGenerator $generator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = resolve(InvoiceEmailGenerator::class);
    }

    /** @test */
    public function invoiceEmailErrorsWithoutRequiredFields(): void
    {
        $data = $this->generator->generate();
        $filename = 'fakeFile.txt';

        foreach ($this->generator->requiredFields() as $field) {
            $dataPassedIn = $data;
            unset($dataPassedIn[$field]);

            try {
                new Invoice($dataPassedIn, $filename);
            } catch (ErrorException $e) {
                static::assertSame('Undefined array key "'.$field.'"', $e->getMessage());
            }
        }
    }

    /** @test */
    public function invoiceEmailPopulatesPassedInDataToContent(): void
    {
        $data = $this->generator->generate();
        $filename = 'fakeFile.txt';
        Storage::fake('local')->put($filename, 'some information');

        $mail = new Invoice($data, $filename);

        foreach ($data as $content) {
            $mail->assertSeeInHtml($content);
        }
    }

    /** @test */
    public function invoiceEmailHasLateMessageWhenPrompted(): void
    {
        $data = $this->generator->generate();
        $filename = 'fakeFile.txt';
        Storage::fake('local')->put($filename, 'some information');

        $mail = new Invoice($data, $filename, true);

        $mail->assertSeeInHtml('class="late"');
    }

    /** @test */
    public function invoiceEmailHasAttachmentPassedIn(): void
    {
        $data = $this->generator->generate();
        $filename = 'fakeFile.txt';
        Storage::fake('local')->put($filename, 'some information');

        $mail = new Invoice($data, $filename, true);

        $built = $mail->build();

        static::assertCount(1, $built->rawAttachments);
    }

    /** @test */
    public function invoiceEmailCanBeSent(): void
    {
        $data = $this->generator->generate();
        $filename = 'fakeFile.txt';
        Storage::fake('local')->put($filename, 'some information');

        Mail::fake();

        Mail::to('example@example.com')->send(new Invoice($data, $filename));

        Mail::assertSent(Invoice::class);
    }
}
