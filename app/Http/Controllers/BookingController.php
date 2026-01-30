<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Route;
use App\Models\Schedule;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function search(Request $request)
    {
        // Fetch active announcements
        $announcements = Announcement::where('is_active', true)
            ->where(function($q) {
                $q->whereNull('valid_until')
                  ->orWhere('valid_until', '>=', now());
            })
            ->latest()
            ->get();

        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $date = $request->input('date');

        $query = Schedule::with(['bus', 'route'])
            ->where('is_active', true)
            ->where('stock_available', '>', 0);

        if ($origin && $destination) {
            $query->whereHas('route', function($q) use ($origin, $destination) {
                $q->where('origin', 'like', "%{$origin}%")
                  ->where('destination', 'like', "%{$destination}%");
            });
        }

        if ($date) {
            $query->whereDate('departure_time', $date);
        }

        $schedules = $query->get();
        
        // Get unique origins and destinations for dropdowns
        $origins = Route::select('origin')->distinct()->pluck('origin');
        $destinations = Route::select('destination')->distinct()->pluck('destination');

        return view('bookings.search', compact('schedules', 'origins', 'destinations', 'announcements'));
    }

    public function create(Schedule $schedule)
    {
        return view('bookings.create', compact('schedule'));
    }

    public function store(Request $request, Schedule $schedule)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $schedule->stock_available,
        ]);

        $totalPrice = $schedule->price * $request->quantity;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Reduce stock
        $schedule->decrement('stock_available', $request->quantity);

        return redirect()->route('bookings.payment', $booking);
    }

    public function payment(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        return view('bookings.payment', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('payments', 'public');

        $booking->update([
            'payment_proof' => $path,
            'status' => 'paid', // Waiting for admin confirmation
        ]);

        return redirect()->route('bookings.my-bookings')->with('success', 'Payment proof uploaded. Waiting for confirmation.');
    }

    public function myBookings()
    {
        $bookings = Booking::with(['schedule.route', 'schedule.bus'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bookings.my-bookings', compact('bookings'));
    }
}
