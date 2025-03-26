<?php
namespace App\Listeners;

use App\Events\PurchaseCompleted;

// use App\Events\PurchaseCompleted;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\SellerNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderPlacedNotification;

class NotifySeller
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

     use InteractsWithQueue;

    public function handle(PurchaseCompleted $event)
    {
        $order = $event->order;
        $seller = $order->product->seller;

        if ($seller) {
            Notification::send($seller, new OrderPlacedNotification($order));
        }
    }
}
