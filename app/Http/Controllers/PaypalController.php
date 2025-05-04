<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PaypalController extends Controller
{
    public function paypal(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'amount' => 'required|numeric|min:1',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string'
        ]);

        try {
            $room = Room::findOrFail($request->room_id);
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $token = $provider->getAccessToken();

            // Store all data in session (alternative to database)
            session([
                'paypal_booking' => [
                    'room_id' => $request->room_id,
                    'user_id' => auth()->id(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'amount' => $request->amount,
                    'currency' => config('paypal.currency')
                ]
            ]);

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('success'),
                    "cancel_url" => route('cancel'),
                    "brand_name" => config('app.name'),
                    "shipping_preference" => "NO_SHIPPING",
                    "user_action" => "PAY_NOW"
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => config('paypal.currency'),
                            "value" => number_format($request->amount, 2, '.', ''),
                            "breakdown" => [
                                "item_total" => [
                                    "currency_code" => config('paypal.currency'),
                                    "value" => number_format($request->amount, 2, '.', '')
                                ]
                            ]
                        ],
                        "items" => [
                            [
                                "name" => "Room Booking: " . $room->room_title,
                                "description" => "Booking from " . $request->start_date . " to " . $request->end_date,
                                "quantity" => "1",
                                "unit_amount" => [
                                    "currency_code" => config('paypal.currency'),
                                    "value" => number_format($request->amount, 2, '.', '')
                                ],
                                "category" => "DIGITAL_GOODS"
                            ]
                        ],
                        "reference_id" => "ROOM-" . $room->id,
                        "description" => "Room Booking Payment",
                        "custom_id" => "CUST-" . auth()->id()
                    ]
                ]
            ]);

            if (isset($response['id'])) {
                session(['paypal_order_id' => $response['id']]);
                
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }

            Log::error('PayPal order creation failed', ['response' => $response]);
            return back()->with('error', 'Payment initialization failed');

        } catch (\Exception $e) {
            Log::error('PayPal Error: ' . $e->getMessage());
            return back()->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $orderId = $request->input('token') ?? session('paypal_order_id');
            
            if (!$orderId) {
                throw new \Exception('Missing PayPal order ID');
            }

            // First verify the payment
            $paymentDetails = $provider->showOrderDetails($orderId);
            
            // Then capture the payment
            $response = $provider->capturePaymentOrder($orderId);
            
            Log::info('PayPal Capture Response:', $response);

            $bookingData = session('paypal_booking');
            
            if (!$bookingData) {
                throw new \Exception('Missing booking data');
            }

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                $booking = Booking::create([
                    'room_id' => $bookingData['room_id'],
                    'user_id' => $bookingData['user_id'],
                    'name' => $bookingData['name'],
                    'email' => $bookingData['email'],
                    'phone' => $bookingData['phone'],
                    'start_date' => $bookingData['start_date'],
                    'end_date' => $bookingData['end_date'],
                    'amount' => $bookingData['amount'],
                    'currency' => $bookingData['currency'],
                    'payment_status' => 'completed',
                    'payment_method' => 'paypal',
                    'transaction_id' => $response['id'],
                    'payment_details' => json_encode($response),
                    'status' => 'confirmed'
                ]);

                session()->forget(['paypal_booking', 'paypal_order_id']);

                return view('payment.success', [
                    'booking' => $booking,
                    'transaction' => $response
                ]);
            }

            throw new \Exception('Payment status: ' . ($response['status'] ?? 'unknown'));

        } catch (\Exception $e) {
            Log::error('Payment Error: ' . $e->getMessage());
            return redirect()->route('cancel')->with('error', $e->getMessage());
        }
    }

    public function cancel()
    {
        session()->forget(['paypal_booking', 'paypal_order_id']);
        return view('home.cancel')->with('error', 
            'Payment was cancelled or failed. Please try again.');
    }
}