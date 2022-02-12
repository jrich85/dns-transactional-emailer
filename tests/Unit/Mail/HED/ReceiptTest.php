<?php

namespace Tests\Unit\Mail\HED;

use App\Mail\HED\Receipt;
use ErrorException;
use Illuminate\Support\Facades\Storage;
use Tests\Support\DataGenerators\ReceiptEmailGenerator;
use Tests\TestCase;

class ReceiptTest extends TestCase
{
    private ReceiptEmailGenerator $generator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = resolve(ReceiptEmailGenerator::class);
    }

    /** @test */
    public function receiptEmailErrorsWithoutRequiredFields(): void
    {
        $data = $this->generator->generate();
        $filename = 'fakeFile.txt';

        foreach ($this->generator->requiredFields() as $field) {
            $dataPassedIn = $data;
            unset($dataPassedIn[$field]);

            try {
                new Receipt($dataPassedIn, $filename);
            } catch (ErrorException $e) {
                static::assertSame('Undefined array key "'.$field.'"', $e->getMessage());
            }
        }
    }

    /** @test */
    public function receiptEmailPopulatesPassedInDataToContent(): void
    {
        $data = $this->generator->generate();
        $filename = 'fakeFile.txt';
        Storage::fake('local')->put($filename, 'some information');

        $mail = new Receipt($data, $filename);

        foreach ($data as $content) {
            $mail->assertSeeInHtml($content);
        }
    }

    /** @test */
    public function receiptEmailHasAttachmentPassedIn(): void
    {
        $data = $this->generator->generate();
        $filename = 'fakeFile.txt';
        Storage::fake('local')->put($filename, 'some information');

        $mail = new Receipt($data, $filename, true);

        $built = $mail->build();

        static::assertCount(1, $built->rawAttachments);
    }
}
