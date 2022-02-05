<?php

namespace App\Mail\HED;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class Receipt extends Mailable
{
    use Queueable, SerializesModels;

    public string $prefix;
    public string $lastName;
    public bool $preview;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $info, string $filename)
    {
        $this->prefix = $info['prefix'];
        $this->lastName = $info['lastName'];
        $this->attachment = $filename;
        $this->preview = $info['preview'] ?? false;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.HED.receipt')
            ->subject('Health and Dental Premium Receipt 2022-23')
            ->attachData(
                Storage::get($this->attachment),
                $this->attachment,
                ['mime' => 'application/pdf']
            );
    }
}
