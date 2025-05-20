<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <style type="text/css">
        body {
            background: #121212;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #e0e0e0;
        }

        .finance-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .page-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }

        .stats-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            padding: 20px;
            flex: 1;
            min-width: 250px;
            transition: transform 0.3s ease;
            border-top: 4px solid;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
            background: #252525;
        }

        .stat-card.primary {
            border-top-color: #3498db;
        }

        .stat-card.success {
            border-top-color: #2ecc71;
        }

        .stat-card.warning {
            border-top-color: #f39c12;
        }

        .stat-title {
            font-size: 16px;
            color: #b0b0b0;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .stat-subtext {
            font-size: 14px;
            color: #888;
        }

        .payment-methods {
            background: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            padding: 20px;
            margin-top: 20px;
        }

        .payment-methods h3 {
            color: #ffffff;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }

        .method-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .method-item {
            background: #252525;
            border-radius: 8px;
            padding: 15px;
            flex: 1;
            min-width: 200px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
        }

        .method-item:hover {
            background: #2e2e2e;
        }

        .method-name {
            font-weight: 600;
            color: #e0e0e0;
        }

        .method-amount {
            font-weight: 700;
            color: #2ecc71;
        }

        .alert-warning {
            background: #332a00;
            color: #ffd700;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ffd700;
        }

        .fa-icon {
            color: inherit;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="finance-container">
            <h1 class="page-title">
                <i class="fas fa-chart-line fa-icon"></i> Hotel Financial Overview
            </h1>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="stats-container">
                <div class="stat-card primary">
                    <div class="stat-title">
                        <i class="fas fa-wallet fa-icon"></i> Total Revenue
                    </div>
                    <div class="stat-value">{{ number_format($metrics['total'], 2) }} DA</div>
                    <div class="stat-subtext">All completed payments</div>
                </div>

                <div class="stat-card success">
                    <div class="stat-title">
                        <i class="fas fa-calendar-alt fa-icon"></i> This Month
                    </div>
                    <div class="stat-value">{{ number_format($metrics['monthly'], 2) }} DA</div>
                    <div class="stat-subtext">{{ $currentPeriod }}</div>
                </div>

                <div class="stat-card warning">
                    <div class="stat-title">
                        <i class="fas fa-exclamation-triangle fa-icon"></i> Outstanding
                    </div>
                    <div class="stat-value">{{ number_format($metrics['unpaid'], 2) }} DA</div>
                    <div class="stat-subtext">Pending payments</div>
                </div>

                <div class="stat-card primary">
                    <div class="stat-title">
                        <i class="fas fa-calendar-day fa-icon"></i> Today's Revenue
                    </div>
                    <div class="stat-value">{{ number_format($metrics['today'], 2) }} DA</div>
                    <div class="stat-subtext">{{ now()->format('l, M d') }}</div>
                </div>
            </div>

            @if($metrics['unpaid'] > 0)
                <div class="alert-warning">
                    <i class="fas fa-exclamation-circle fa-icon"></i> 
                    You have {{ number_format($metrics['unpaid'], 2) }} DA in outstanding payments that require attention.
                </div>
            @endif

            <div class="payment-methods">
                <h3><i class="fas fa-credit-card fa-icon"></i> Revenue by Payment Method</h3>
                <div class="method-list">
                    @forelse($paymentMethods as $method)
                        <div class="method-item">
                            <span class="method-name">
                                @switch($method['method'])
                                    @case('Credit Card')
                                        <i class="fas fa-credit-card fa-icon"></i> Credit Card
                                        @break
                                    @case('PayPal')
                                        <i class="fab fa-paypal fa-icon"></i> PayPal
                                        @break
                                    @case('Bank Transfer')
                                        <i class="fas fa-university fa-icon"></i> Bank Transfer
                                        @break
                                    @case('Manual Payment')
                                        <i class="fas fa-money-bill-wave fa-icon"></i> Manual Payment
                                        @break
                                    @default
                                        <i class="fas fa-cash-register fa-icon"></i> {{ $method['method'] }}
                                @endswitch
                            </span>
                            <span class="method-amount">{{ number_format($method['total'], 2) }} DA</span>
                        </div>
                    @empty
                        <p style="color: #b0b0b0;">No payment method data available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
