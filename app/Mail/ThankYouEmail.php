<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderId;
    public $amount;

    /**
     * Create a new message instance.
     *
     * @param string $orderId
     * @param float $amount
     */
    public function __construct($orderId, $amount)
    {
        $this->orderId = $orderId;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pages.thankyou')
                    ->subject('Cảm ơn bạn đã thanh toán');
    }
}
