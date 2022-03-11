<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use App\Dish;
use App\User;

class SendToRestaurantOrderEmail extends Mailable
{
    use Queueable, SerializesModels;
    
     private $new_order;
     private $restaurant;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $new_order, User $restaurant)
    {
        $this->new_order = $new_order;
        $this->restaurant = $restaurant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ordine ricevuto' )->view('mails.confirmedRestaurant')
        ->with([
            'new_order' => $this->new_order,
            'restaurant' => $this->restaurant,
        ]);
    }
}
