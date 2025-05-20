<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('receptionist.header')
    @include('receptionist.css')
    <title>Official Booking Receipt</title>
    <style type="text/css">
        :root {
            --primary: #000000;         /* Black as primary color */
            --primary-light: #333333;   /* Dark gray */
            --secondary: #555555;       /* Medium gray */
            --dark-bg: #121212;         /* Dark background */
            --card-bg: #1a1a1a;         /* Slightly lighter black */
            --text-primary: #ffffff;    /* White text */
            --text-secondary: #cccccc;  /* Light gray */
            --accent: #4d4d4d;          /* Accent color */
            --border: #333333;          /* Border color */
            --highlight: #2a2a2a;       /* Highlight color */
        }
        
        body {
            background-color: var(--dark-bg);
            color: var(--text-primary);
            font-family: 'Georgia', 'Times New Roman', serif;
            line-height: 1.6;
        }
        
        .receipt-container {
            max-width: 700px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .receipt-card {
            background: var(--card-bg);
            border-radius: 0;            /* Sharp corners for formal look */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            border: 2px solid var(--primary);
        }
        
        .receipt-header {
            background: var(--primary);
            padding: 1.5rem;
            text-align: center;
            border-bottom: 2px solid var(--accent);
        }
        
        .receipt-header h2 {
            font-weight: 700;
            margin: 0;
            font-size: 1.8rem;
            letter-spacing: 1px;
            color: white;
            text-transform: uppercase;
            font-family: 'Helvetica', 'Arial', sans-serif;
        }
        
        .receipt-body {
            padding: 2.5rem;
        }
        
        .receipt-section {
            margin-bottom: 2rem;
        }
        
        .section-title {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 1.2rem;
            font-size: 1.2rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 0.7rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .detail-label {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 1.05rem;
        }
        
        .detail-value {
            font-weight: 400;
            color: var(--text-primary);
        }
        
        .total-section {
            background: var(--highlight);
            border-radius: 4px;
            padding: 2rem;
            margin-top: 2.5rem;
            border: 1px solid var(--border);
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 1.15rem;
            margin-bottom: 0.8rem;
        }
        
        .grand-total {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px dashed var(--border);
        }
        
        .receipt-footer {
            text-align: center;
            padding: 1.8rem;
            border-top: 2px solid var(--border);
            background: var(--highlight);
        }
        
        .btn-print {
            background: var(--primary);
            color: white;
            border: 1px solid var(--text-secondary);
            padding: 0.85rem 2.5rem;
            border-radius: 0;            /* Sharp corners */
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.95rem;
        }
        
        .btn-print:hover {
            background: var(--primary-light);
            border-color: white;
        }
        
        @media print {
            body {
                background: white !important;
                color: black !important;
            }
            .receipt-card {
                box-shadow: none;
                border: 2px solid black !important;
            }
            .btn-print {
                display: none;
            }
            .detail-value {
                color: black !important;
            }
        }
        
        @media (max-width: 640px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 0.3rem;
            }
            .receipt-body {
                padding: 1.5rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Georgia&family=Helvetica:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="receipt-container">
            <div class="receipt-card">
                <div class="receipt-header">
                    <h2><i class="fas fa-hotel"></i> OFFICIAL BOOKING RECEIPT</h2>
                </div>
                
                <div class="receipt-body">
                    <div class="receipt-section">
                        <h3 class="section-title">Transaction Details</h3>
                        <div class="detail-grid">
                            <div class="detail-label">Receipt Number:</div>
                            <div class="detail-value">#{{ str_pad($booking->id, 8, '0', STR_PAD_LEFT) }}</div>
                            
                            <div class="detail-label">Date & Time:</div>
                            <div class="detail-value">{{ now()->format('F j, Y \a\t g:i A') }}</div>
                            
                            <div class="detail-label">Status:</div>
                            <div class="detail-value" style="color: #4CAF50;">CONFIRMED</div>
                        </div>
                    </div>
                    
                    <div class="receipt-section">
                        <h3 class="section-title">Accommodation Details</h3>
                        <div class="detail-grid">
                            <div class="detail-label">Room Number:</div>
                            <div class="detail-value">{{ $room->room_number }}</div>
                            
                            <div class="detail-label">Room Category:</div>
                            <div class="detail-value">{{ ucfirst($room->room_type) }}</div>
                            
                            <div class="detail-label">Description:</div>
                            <div class="detail-value">{{ $room->room_title }}</div>
                        </div>
                    </div>
                    
                    <div class="receipt-section">
                        <h3 class="section-title">Reservation Period</h3>
                        <div class="detail-grid">
                            <div class="detail-label">Check-in:</div>
                            <div class="detail-value">{{ \Carbon\Carbon::parse($booking->start_date)->format('l, F j, Y') }}</div>
                            
                            <div class="detail-label">Check-out:</div>
                            <div class="detail-value">{{ \Carbon\Carbon::parse($booking->end_date)->format('l, F j, Y') }}</div>
                            
                            <div class="detail-label">Duration:</div>
                            <div class="detail-value">
                                {{ $nights = \Carbon\Carbon::parse($booking->start_date)->diffInDays($booking->end_date) }} 
                                night(s)
                            </div>
                        </div>
                    </div>
                    
                    <div class="total-section">
                        <h3 class="section-title">Payment Breakdown</h3>
                        
                        <div class="detail-grid">
                     
                            
                            <div class="detail-label">Room Charges:</div>
                            <div class="detail-value">{{ number_format($room->price_per_night * $nights, 2) }} DA</div>
                            
                            @php
                                $additionalServicePrice = $additionalServicePrice ?? ($booking->additional_service_price ?? 0);
                            @endphp
                            
                            @if($additionalServicePrice > 0)
                                <div class="detail-label">Additional Services:</div>
                                <div class="detail-value">+ {{ number_format($additionalServicePrice, 2) }} DA</div>
                            @endif
                        </div>
                        
                        <div class="grand-total">
                            <div class="total-row">
                                <span>TOTAL AMOUNT:</span>
                                <span>{{ number_format(($room->price_per_night * $nights) + $additionalServicePrice, 2) }} DA</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="receipt-footer">
                    <button onclick="window.print()" class="btn-print">
                        <i class="fas fa-print"></i> PRINT OFFICIAL RECEIPT
                    </button>
                    <p style="margin-top: 1rem; font-size: 0.9rem; color: var(--text-secondary);">
                        Thank you for choosing our establishment
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>