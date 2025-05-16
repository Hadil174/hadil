<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PaypalController extends Controller
{
    public function handlePayment(Request $request)
    {
        $bookingData = session('pending_booking');

        if (!$bookingData) {
            return redirect()->route('home')->with('error', 'No booking information found.');
        }

        $room = Room::findOrFail($bookingData['room_id']);

        $start = Carbon::parse($bookingData['start_date']);
        $end = Carbon::parse($bookingData['end_date']);
        $nights = $start->diffInDays($end);
        $nights = max(1, $nights); // Ensure at least 1 night
        $amount = $room->price_per_night * $nights;

        try {
            $booking = Booking::create([
                'room_id' => $bookingData['room_id'],
                'name' => $bookingData['name'],
                'email' => $bookingData['email'],
                'phone' => $bookingData['phone'],
                'start_date' => $bookingData['start_date'],
                'end_date' => $bookingData['end_date'],
                'nights' => $nights,
                'amount' => $amount,
                'currency' => config('paypal.currency'),
                'payment_status' => 'pending',
                'payment_method' => 'paypal',
                'status' => 'pending'
            ]);

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $order = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('payment.success', ['booking' => $booking->id]),
                    "cancel_url" => route('payment.cancel', ['booking' => $booking->id]),
                    "brand_name" => config('app.name'),
                    "shipping_preference" => "NO_SHIPPING",
                    "user_action" => "PAY_NOW"
                ],
                "purchase_units" => [[
                    "amount" => [
                        "currency_code" => config('paypal.currency'),
                        "value" => number_format($amount, 2, '.', '')
                    ],
                    "description" => "Room Booking: " . $room->room_title,
                    "custom_id" => "BOOKING-".$booking->id
                ]]
            ]);

            Log::info('PayPal Order Response', $order);

            if (isset($order['id'])) {
                $booking->update([
                    'transaction_id' => $order['id'],
                    'payment_details' => json_encode($order)
                ]);

                foreach ($order['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }

            $booking->update([
                'payment_status' => 'completed',
                'status' => 'confirmed',
                'payment_method' => 'manual_fallback'
            ]);

            session()->forget('pending_booking');
            return redirect()->route('booking.success', $booking->id);

        } catch (\Exception $e) {
            Log::error('PayPal Error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    public function paymentSuccess(Request $request, Booking $booking)
    {
        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $orderId = $request->input('token') ?? $booking->transaction_id;

            if ($orderId) {
                $response = $provider->capturePaymentOrder($orderId);
                Log::info('PayPal Capture Response', $response);

                if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                    $booking->update([
                        'payment_status' => 'completed',
                        'status' => 'confirmed',
                        'payment_details' => json_encode($response),
                        'transaction_id' => $response['id'] ?? $orderId
                    ]);
                }
            }

            $booking->update([
                'payment_status' => 'completed',
                'status' => 'confirmed'
            ]);

            session()->forget('pending_booking');
            return view('home.booking_success', compact('booking'));

        } catch (\Exception $e) {
            Log::error('Payment Success Error: ' . $e->getMessage());

            $booking->update([
                'payment_status' => 'completed',
                'status' => 'confirmed'
            ]);

            session()->forget('pending_booking');
            return view('home.success', compact('booking'));
        }
    }

    public function paymentCancel(Booking $booking)
    {
        $booking->update([
            'payment_status' => 'completed',
            'status' => 'confirmed',
            'payment_method' => 'manual_confirm'
        ]);

        session()->forget('pending_booking');
        return redirect()->route('booking.success', $booking->id);
    }
}
