<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('receptionist.css')

    <style>
        body {
            background-color: #f7fafc;
            font-family: 'Segoe UI', sans-serif;
        }

        .notification-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .notification-title {
            text-align: center;
            font-size: 28px;
            color: #2d3748;
            margin-bottom: 30px;
            position: relative;
        }

        .notification-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: #4299e1;
            margin: 10px auto 0;
            border-radius: 4px;
        }

        .notification-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-left: 5px solid #4299e1;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .notification-left {
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-icon {
            font-size: 24px;
            color: #4299e1;
        }

        .notification-body {
            flex: 1;
        }

        .notification-header {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .price-tag {
            font-size: 14px;
            background: #ebf8ff;
            color: #3182ce;
            padding: 4px 8px;
            border-radius: 6px;
            margin-left: 10px;
        }

        .notification-meta {
            font-size: 14px;
            color: #718096;
            margin-bottom: 8px;
        }

        .notification-notes {
            font-size: 15px;
            color: #4a5568;
        }

        @media (max-width: 768px) {
            .notification-card {
                flex-direction: column;
            }

            .notification-left {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <div class="notification-container">
                <h2 class="notification-title">Guest Service Notifications</h2>

                @foreach ($services as $service)
                    <div class="notification-card">
                        <div class="notification-left">
                            <div class="notification-icon">
                                <i class="fas fa-concierge-bell"></i>
                            </div>
                        </div>
                        <div class="notification-body">
                            <div class="notification-header">
                                {{ $service->service_name }}
                                <span class="price-tag">{{ $service->price }} DA</span>
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>
