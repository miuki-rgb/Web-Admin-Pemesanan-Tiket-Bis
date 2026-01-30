<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Announcement;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function getSchedules(Request $request)
    {
        // DEBUG MODE: Show ALL active schedules regardless of time
        $query = Schedule::with(['bus', 'route'])
            ->where('is_active', true);

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('route', function($q) use ($search) {
                $q->where('origin', 'like', "%{$search}%")
                  ->orWhere('destination', 'like', "%{$search}%");
            });
        }

        $schedules = $query->orderBy('departure_time', 'asc')->get();

        return response()->json($schedules);
    }

    public function getAnnouncements()
    {
        $announcements = Announcement::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($announcements);
    }

    public function getLocations()
    {
        $origins = \App\Models\Route::distinct()->pluck('origin');
        $destinations = \App\Models\Route::distinct()->pluck('destination');

        return response()->json([
            'origins' => $origins,
            'destinations' => $destinations,
        ]);
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string', // Just to store logic if needed, currently schema doesn't have it but prompt mentions it.
        ]);

        $user = $request->user();
        $schedule = Schedule::find($request->schedule_id);

        if ($schedule->stock_available < $request->quantity) {
            return response()->json(['message' => 'Not enough seats available'], 400);
        }

        // Logic for total price
        $totalPrice = $schedule->price * $request->quantity;

        // Generate QR Data (Simple string for now)
        $qrData = 'TICKET-' . $user->id . '-' . $schedule->id . '-' . time();

        $booking = Booking::create([
            'user_id' => $user->id,
            'schedule_id' => $schedule->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'paid', // Simulating successful payment
            'qr_code_data' => $qrData,
        ]);

        // Reduce stock
        $schedule->decrement('stock_available', $request->quantity);

        return response()->json([
            'message' => 'Booking successful',
            'booking' => $booking,
        ]);
    }

    public function getMyTickets(Request $request)
    {
        $tickets = Booking::with(['schedule.bus', 'schedule.route'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($tickets);
    }

    public function scanTicket(Request $request)
    {
        $request->validate([
            'qr_code_data' => 'required|string'
        ]);

        $booking = Booking::where('qr_code_data', $request->qr_code_data)->first();

        if (!$booking) {
            return response()->json(['message' => 'Tiket tidak ditemukan!'], 404);
        }

        if ($booking->status === 'used') {
            return response()->json([
                'message' => 'Tiket sudah pernah digunakan sebelumnya!',
                'status' => 'already_used'
            ], 400);
        }

        if ($booking->status !== 'confirmed') {
            return response()->json(['message' => 'Tiket belum dikonfirmasi oleh admin!'], 400);
        }

        // FORCE UPDATE AND SAVE WITH TRANSACTION
        DB::transaction(function () use ($booking) {
            $booking->status = 'used';
            $booking->save();
        });
        
        $booking->refresh();

        return response()->json([
            'message' => 'Tiket Berhasil di-scan. Penumpang dipersilakan masuk.',
            'status' => 'success',
            'booking' => $booking
        ]);
    }

    public function serveImage($filename)
    {
        $path = storage_path('app/public/announcements/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function serveProfileImage($filename)
    {
        $path = storage_path('app/public/profiles/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
