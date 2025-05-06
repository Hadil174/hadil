<?php

// app/Notifications/NewServiceRequest.php

use Illuminate\Notifications\Notification;
use Illuminate\Bus\Queueable;

class NewServiceRequest extends Notification
{
    use Queueable;

    public $serviceRequest;

    public function __construct($serviceRequest)
    {
        $this->serviceRequest = $serviceRequest;
    }

    public function via($notifiable)
    {
        return ['database']; // Store in DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'New service request from guest: ' . $this->serviceRequest->guest->name,
            'service_name' => $this->serviceRequest->service_name,
            'price' => $this->serviceRequest->price,
            'guest_id' => $this->serviceRequest->guest_id,
            'service_id' => $this->serviceRequest->id,
        ];
    }
}


