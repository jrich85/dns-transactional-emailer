<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    public string $prefix;
    public string $lastName;
    public string $dueDate;
    public string $membershipNum;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $info)
    {
        $this->prefix = $info->prefix ?? '';
        $this->lastName = $info->lastName ?? '';
        $this->dueDate = $info->dueDate ?? '';
        $this->membershipNum = $info->membershipNum ?? '';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('email.invoice');
    }
}
