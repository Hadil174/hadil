<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('receptionist.header')
    @include('receptionist.css')
    <title>Payment Confirmation</title>
    <style>
        :root {
            --primary: #000000;  /* Black as primary color */
            --primary-dark: #333333;  /* Dark gray */
            --dark-bg: #121212;  /* Dark background */
            --card-bg: #1e1e1e;  /* Slightly lighter black for card */
            --text-light: #ffffff;  /* White text */
            --text-muted: #b3b3b3;  /* Light gray for secondary text */
            --border: #333333;  /* Border color */
            --accent: #4d4d4d;  /* Accent color */
        }
        
        body {
            background-color: var(--dark-bg);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .staff-confirmation-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }
        
        .staff-confirmation {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border);
        }
        
        .staff-confirmation h2 {
            color: var(--text-light);  /* White for header */
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-size: 1.8rem;
            border-bottom: 1px solid var(--accent);
            padding-bottom: 1rem;
        }
        
        .receipt {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--accent);
        }
        
        .receipt p {
            margin: 0.8rem 0;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
        }
        
        .receipt p span:first-child {
            color: var(--text-muted);
            font-weight: 500;
        }
        
        .receipt p span:last-child {
            font-weight: 500;
            color: var(--text-light);
        }
        
        .btn-print {
            background: var(--primary);
            color: white;
            border: 1px solid var(--accent);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0 auto;
        }
        
        .btn-print:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            border-color: var(--text-muted);
        }
        
        @media print {
            body {
                background: white !important;
                color: black !important;
            }
            .staff-confirmation {
                box-shadow: none;
                border: 1px solid #ddd;
                background: white;
                color: black;
            }
            .receipt {
                background: #f9f9f9;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('receptionist.sidebar')
    
    <div class="staff-confirmation-container">
        <div class="staff-confirmation">
            <h2><i class="fas fa-check-circle" style="color: #4CAF50;"></i> Payment Received</h2>
            
            <div class="receipt">
                <p>
                    <span>Booking Reference:</span>
                    <span>#{{ $booking->id }}</span>
                </p>
                <p>
                    <span>Date:</span>
                    <span>{{ now()->format('d M Y, h:i A') }}</span>
                </p>
                <p>
                    <span>Amount:</span>
                    <span>${{ number_format($booking->amount, 2) }} DZD</span>
                </p>
                <p>
                    <span>Payment Method:</span>
                    <span>{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</span>
                </p>
                <p>
                    <span>Processed By:</span>
                    <span>{{ auth()->user()->name }}</span>
                </p>
            </div>
            
            <button onclick="window.print()" class="btn-print">
                <i class="fas fa-print"></i> Print Receipt
            </button>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>