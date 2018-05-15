<?php

namespace App\Mail;

use App\Advertisment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvertismentApprovedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $Advertisment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Advertisment $Advertisment)
    {
        $this->Advertisment = $Advertisment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Advertisment Approved!');
        return $this->view('email.approved');
    }
}
