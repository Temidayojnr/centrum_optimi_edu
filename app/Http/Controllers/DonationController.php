<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_published', true)
            ->where('status', 'active')
            ->get();

        return view('donate', compact('programs'));
    }

    public function initiate(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:100',
            'program_id' => 'nullable|exists:programs,id',
            'message' => 'nullable|string|max:500',
            'is_anonymous' => 'boolean',
            'payment_method' => 'required|in:paystack,flutterwave',
        ]);

        $donation = Donation::create([
            'transaction_reference' => 'TXN-' . strtoupper(Str::random(12)),
            'donor_name' => $validated['donor_name'],
            'donor_email' => $validated['donor_email'],
            'donor_phone' => $validated['donor_phone'] ?? null,
            'amount' => $validated['amount'],
            'currency' => 'NGN',
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'program_id' => $validated['program_id'] ?? null,
            'message' => $validated['message'] ?? null,
            'is_anonymous' => $validated['is_anonymous'] ?? false,
        ]);

        // Initialize payment with payment gateway
        if ($validated['payment_method'] === 'paystack') {
            return $this->initiatePaystack($donation);
        } else {
            return $this->initiateFlutterwave($donation);
        }
    }

    private function initiatePaystack($donation)
    {
        // Paystack integration
        $paystack_secret = config('services.paystack.secret_key');
        
        $data = [
            'email' => $donation->donor_email,
            'amount' => $donation->amount * 100, // Convert to kobo
            'reference' => $donation->transaction_reference,
            'callback_url' => route('donation.callback'),
            'metadata' => [
                'donation_id' => $donation->id,
                'donor_name' => $donation->donor_name,
                'program_id' => $donation->program_id,
            ],
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.paystack.co/transaction/initialize');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $paystack_secret,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if ($result['status']) {
            return redirect($result['data']['authorization_url']);
        }

        return back()->with('error', 'Unable to initialize payment. Please try again.');
    }

    private function initiateFlutterwave($donation)
    {
        // Flutterwave integration placeholder
        return back()->with('error', 'Flutterwave payment is being configured.');
    }

    public function callback(Request $request)
    {
        $reference = $request->query('reference');
        
        if (!$reference) {
            return redirect()->route('donate')->with('error', 'Invalid payment reference.');
        }

        // Verify payment with Paystack
        $paystack_secret = config('services.paystack.secret_key');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/verify/{$reference}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $paystack_secret,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if ($result['status'] && $result['data']['status'] === 'success') {
            $donation = Donation::where('transaction_reference', $reference)->first();
            
            if ($donation) {
                $donation->update([
                    'status' => 'successful',
                    'paid_at' => now(),
                    'payment_data' => $result['data'],
                ]);

                // Send confirmation email
                // Mail::to($donation->donor_email)->send(new DonationConfirmation($donation));

                return redirect()->route('donation.success', $donation->token);
            }
        }

        return redirect()->route('donate')->with('error', 'Payment verification failed.');
    }

    public function success($token)
    {
        $donation = Donation::where('token', $token)->firstOrFail();
        if ($donation->status !== 'successful') {
            abort(404);
        }

        return view('donation-success', compact('donation'));
    }
}
