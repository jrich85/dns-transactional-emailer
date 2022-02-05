<?php

namespace App\Mail\HED;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    public string $attachment;
    public string $dueDate;
    public bool $isLate;
    public string $lastName;
    public string $membershipNum;
    public string $prefix;
    public bool $preview;
    public string $subjectLine;

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
        $this->subjectLine = $this->isLate
            ? 'ACTION REQUIRED: Your health and dental coverage will be terminated on March 21, 2022'
            : 'Health and Dental Premium Invoice 2022-23';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.HED.invoice')
            ->subject($this->subjectLine)
            ->attachData(
                Storage::get($this->attachment),
                $this->attachment,
                ['mime' => 'application/pdf']
            );
    }
}
