<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('receptionist.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Notifications</title>

    <!-- Google Fonts + FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            font-family: 'Inter', sans-serif;
            color: #e0e0e0;
        }

        .page-content {
            max-width: 960px;
            margin: 50px auto;
            padding: 20px;
        }

        .notification-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 40px;
            color: #ffffff;
            position: relative;
        }

        .notification-title::after {
            content: '';
            display: block;
            width: 70px;
            height: 3px;
            background-color: #3b82f6;
            margin: 10px auto 0;
            border-radius: 4px;
        }

        .notification-card {
            background: #1e1e1e;
            border-left: 6px solid #3b82f6;
            border-radius: 14px;
            padding: 22px 26px;
            margin-bottom: 20px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.6);
            transition: transform 0.2s;
        }

        .notification-card:hover {
            transform: translateY(-3px);
        }

        .notification-header {
            font-size: 1.2rem;
            font-weight: 600;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-tag {
            background: #1d4ed8;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.9rem;
            color: #ffffff;
            font-weight: 500;
        }

        .notification-meta {
            font-size: 0.95rem;
            color: #a1a1aa;
            margin-top: 10px;
        }

        .notification-notes {
            margin-top: 10px;
            color: #d1d5db;
            font-style: italic;
        }

        .notification-icon {
            color: #60a5fa;
            margin-right: 10px;
        }

        @media (max-width: 600px) {
            .notification-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .price-tag {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <h2 class="notification-title">🔔 Guest Service Notifications</h2>

        @forelse ($services as $service)
            <div class="notification-card">
                <div class="notification-header">
                    <span>
                        <i class="fas fa-concierge-bell notification-icon"></i>
                        {{ $service->service_name }}
                    </span>
                    <span class="price-tag">{{ number_format($service->price, 2) }} DA</span>
                </div>
                <div class="notification-meta">
                    🧍 Guest: <strong>{{ $service->guest->name ?? 'N/A' }}</strong> |
                    🏨 Room: <strong>{{ $service->room->room_number ?? 'N/A' }}</strong> |
                    🕒 {{ $service->created_at->format('d M Y, H:i') }}
                </div>
                <div class="notification-notes">
                    {{ $service->notes ?? 'No additional notes' }}
                </div>
            </div>
        @empty
            <p style="text-align:center; color: #888;">No service notifications to display.</p>
        @endforelse
    </div>

    @include('receptionist.footer')
</body>
</html>
