<?php

namespace App\Mail\HED;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class Invoice extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $prefix;
    public string $lastName;
    public string $dueDate;
    public string $membershipNum;
    public bool $isLate;
    public string $attachment;
    public bool $preview;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $info, string $filename, bool $isLate = false)
    {
        $this->prefix = $info['prefix'];
        $this->lastName = $info['lastName'];
        $this->dueDate = $info['dueDate'];
        $this->membershipNum = $info['membershipNum'];
        $this->preview = $info['preview'] ?? false;
        $this->isLate = $isLate;
        $this->attachment = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.HED.invoice')
            ->subject('Health and Dental Premium Invoice 2022-23')
            ->attachData(
                Storage::get($this->attachment),
                $this->attachment,
                ['mime' => 'application/pdf']
            );
    }
}
