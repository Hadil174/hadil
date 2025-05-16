<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('receptionist.css')
    <title>Booking Receipt</title>
    <style type="text/css">
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #64748b;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --accent: #6366f1;
            --border: #334155;
        }
        
        body {
            background-color: var(--dark-bg);
            color: var(--text-primary);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            line-height: 1.6;
        }
        
        .receipt-container {
            max-width: 700px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .receipt-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid var(--border);
        }
        
        .receipt-header {
            background: var(--primary);
            padding: 1.5rem;
            text-align: center;
            color: white;
        }
        
        .receipt-header h2 {
            font-weight: 600;
            margin: 0;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }
        
        .receipt-body {
            padding: 2rem;
        }
        
        .receipt-section {
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            color: var(--primary);
            font-weight: 500;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 0.5rem;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1rem;
            margin-bottom: 0.8rem;
        }
        
        .detail-label {
            color: var(--text-secondary);
            font-weight: 500;
        }
        
        .detail-value {
            font-weight: 400;
        }
        
        .total-section {
            background: rgba(59, 130, 246, 0.1);
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid var(--border);
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
        }
        
        .grand-total {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary);
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed var(--border);
        }
        
        .receipt-footer {
            text-align: center;
            padding: 1.5rem;
            border-top: 1px solid var(--border);
        }
        
        .btn-print {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-print:hover {
            background: var(--primary-dark);
        }
        
        @media print {
            body {
                background: white !important;
                color: black !important;
            }
            .receipt-card {
                box-shadow: none;
                border: none;
            }
            .btn-print {
                display: none;
            }
        }
        
        @media (max-width: 640px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="receipt-container">
            <div class="receipt-card">
                <div class="receipt-header">
                    <h2>BOOKING RECEIPT</h2>
                </div>
                
                <div class="receipt-body">
                    <div class="receipt-section">
                        <h3 class="section-title">Booking Information</h3>
                        <div class="detail-grid">
                            <div class="detail-label">Booking Reference:</div>
                            <div class="detail-value">#{{ $booking->id }}</div>
                            
                            <div class="detail-label">Date Issued:</div>
                            <div class="detail-value">{{ now()->format('d M Y, h:i A') }}</div>
                        </div>
                    </div>
                    
                    <div class="receipt-section">
                        <h3 class="section-title">Room Details</h3>
                        <div class="detail-grid">
                            <div class="detail-label">Room Number:</div>
                            <div class="detail-value">{{ $room->room_number }}</div>
                            
                            <div class="detail-label">Room Type:</div>
                            <div class="detail-value">{{ $room->room_type }}</div>
                            
                            <div class="detail-label">Room Title:</div>
                            <div class="detail-value">{{ $room->room_title }}</div>
                        </div>
                    </div>
                    
                    <div class="receipt-section">
                        <h3 class="section-title">Stay Details</h3>
                        <div class="detail-grid">
                            <div class="detail-label">Check-in Date:</div>
                            <div class="detail-value">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</div>
                            
                            <div class="detail-label">Check-out Date:</div>
                            <div class="detail-value">{{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</div>
                            
                            <div class="detail-label">Nights:</div>
                            <div class="detail-value">
                                @php
                                    $nights = \Carbon\Carbon::parse($booking->start_date)->diffInDays($booking->end_date);
                                    echo $nights;
                                @endphp
                            </div>
                        </div>
                    </div>
                    
                    <div class="total-section">
                        <h3 class="section-title">Payment Summary</h3>
                        
                        <div class="detail-grid">
                            
                            
                            
                            <div class="detail-label">Room Subtotal:</div>
                            <div class="detail-value">{{ number_format($room->price_per_night * $nights, 2) }} DA</div>
                            
                            @php
                                $additionalServicePrice = $additionalServicePrice ?? ($booking->additional_service_price ?? 0);
                            @endphp
                            
                            @if($additionalServicePrice > 0)
                                <div class="detail-label">Additional Services:</div>
                                <div class="detail-value">{{ number_format($additionalServicePrice, 2) }} DA</div>
                            @endif
                        </div>
                        
                        <div class="grand-total">
                            <div class="total-row">
                                <span>TOTAL:</span>
                                <span>{{ number_format(($room->price_per_night * $nights) + $additionalServicePrice, 2) }} DA</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="receipt-footer">
                    <button onclick="window.print()" class="btn-print">
                        <i class="fas fa-print"></i> Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>