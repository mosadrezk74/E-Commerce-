<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('طلب جديد!')
            ->greeting('مرحبًا ' . $notifiable->name)
            ->line('لقد تلقيت طلبًا جديدًا!')
            ->line('رقم الطلب: ' . $this->order->id)
            ->action('عرض الطلب', url('/admin/orders/' . $this->order->id))
            ->line('شكرًا لاستخدام منصتنا!');
    }
}
