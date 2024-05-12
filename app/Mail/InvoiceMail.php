<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Header;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;
use App\Models\Reservation;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $reservation;
    /**
     * Create a new message instance.
     */
    public function __construct(Invoice $invoice, Reservation $reservation)
    {
        $this->invoice = $invoice;
        $this->reservation = $reservation;
    }

    //header

    public function build()
    {
        return $this->markdown('emails.invoice')
                    ->with('invoice', $this->invoice)
                    ->with('details', $this->reservation);
    }
}
