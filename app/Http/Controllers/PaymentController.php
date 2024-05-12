<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Reservation;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // Validate the request data
        $request->validate([
            'course_id' => 'required',
            'location_id' => 'required',
            'date' => 'required|date',
            'time_slot' => 'required',
        ]);

        $token = bin2hex(random_bytes(32));

        // Fetch the course
        $course = Course::find($request->course_id);

        // Set the Stripe API key
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        // Create a new Checkout Session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Total Cost',
                    ],
                    'unit_amount' => $course->price * 100, // Convert to cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('success', ['token' => $token]),
            'cancel_url' => route('reservation.create'),
        ]);

        // Split the time_slot data into start_time, end_time, and instructor_id
        list($start_time, $end_time, $instructor_id) = explode(',', $request->time_slot);

        // Store the form data in the session
        $request->session()->put('formData', [
            'course_id' => $request->course_id,
            'location_id' => $request->location_id,
            'date' => $request->date,
            'duo_name' => $request->duo_name,
            'duo_email' => $request->duo_email,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'instructor_id' => $instructor_id, // Store the instructor_id in the session
        ]);

        $request->session()->put('success_token', $token);

        // Redirect to the checkout page
        return redirect()->away($session->url);
    }

    public function success(Request $request, $token)
    {
        // Check if the token exists in the session
        if ($request->session()->get('success_token') !== $token) {
            // If the token does not exist or does not match, redirect to a different page
            return redirect()->route('dashboard');
        }

        // Retrieve the form data from the session
        $formData = $request->session()->get('formData');

        // Create a new Reservation
        $reservation = Reservation::create([
            'client_id' => Auth::id(),
            'course_id' => $formData['course_id'],
            'location_id' => $formData['location_id'],
            'instructor_id' => $formData['instructor_id'], // Get the instructor_id from the session data
            'date' => $formData['date'],
            'duo_name' => $formData['duo_name'],
            'duo_email' => $formData['duo_email'],
            'start_time' => $formData['start_time'],
            'end_time' => $formData['end_time'],
        ]);

        // Create a new Order
        $invoice= Invoice::create([
            'reservation_id' => $reservation->id,
            'status' => 'paid',
            'amount' => $reservation->course->price,
        ]);

        //Mail to client and duo
        $emails = [$reservation->client->email];
        if ($reservation->duo_email != null) {
            $emails[] = $reservation->duo_email;
        }

        foreach ($emails as $email) {
            Mail::to($email)->send(new InvoiceMail($invoice, $reservation));
        }

        // Clear the formData session data after creating the Ride and Invoice
        $request->session()->forget('formData');

        // Remove the token from the session
        $request->session()->forget('success_token');

        // Redirect to the success page
        return view('success')->with('success', 'Ride booked successfully!');
    }
}
