<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewServiceRequest extends Notification
{
    use Queueable;

    public $serviceRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($serviceRequest)
    {
        $this->serviceRequest = $serviceRequest;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Important to store it in DB
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'New service request submitted.',
            'service_name' => $this->serviceRequest->service_name,
            'guest_id' => $this->serviceRequest->guest_id,
            'time' => now()->format('Y-m-d H:i:s'),
        ];
    }
}
