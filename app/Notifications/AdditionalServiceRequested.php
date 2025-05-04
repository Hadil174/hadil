<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdditionalServiceRequested extends Notification
{
    use Queueable;

    protected $serviceData;

    public function __construct($serviceData)
    {
        $this->serviceData = $serviceData;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // store in notifications table
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'New additional service requested.',
            'service_name' => $this->serviceData['service_name'],
            'time' => now()->toDateTimeString(),
        ];
    }
}


