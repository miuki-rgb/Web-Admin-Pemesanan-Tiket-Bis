<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'schedule.route', 'schedule.bus'])
            ->latest()
            ->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function verifyPayment(Request $request, Booking $booking)
    {
        $action = $request->input('action'); // 'accept' or 'reject'

        if ($action === 'accept') {
            $booking->update(['status' => 'confirmed']);
            // Here you might trigger an email notification or generate the QR code string if not already done.
            // For simplicity, let's assume QR code is generated upon confirmation.
            $booking->update(['qr_code_data' => 'BOOK-' . $booking->id . '-' . uniqid()]);
            
            return redirect()->back()->with('success', 'Payment verified. Booking confirmed.');
        } elseif ($action === 'reject') {
            $booking->update(['status' => 'cancelled']);
            return redirect()->back()->with('error', 'Payment rejected. Booking cancelled.');
        }

        return redirect()->back();
    }

    public function showScanner()
    {
        return view('admin.bookings.scanner');
    }

    public function scanTicket(Request $request)
    {
        $qrData = $request->input('qr_code');

        $booking = Booking::where('qr_code_data', $qrData)->first();

        if (!$booking) {
            return response()->json(['valid' => false, 'message' => 'Tiket tidak ditemukan!']);
        }

        if ($booking->status === 'used') {
            return response()->json(['valid' => false, 'message' => 'Tiket sudah pernah digunakan sebelumnya!']);
        }

        if ($booking->status !== 'confirmed') {
            return response()->json(['valid' => false, 'message' => 'Tiket belum dikonfirmasi oleh admin! Status: ' . $booking->status]);
        }

        // UPDATE STATUS TO USED PERMANENTLY
        \Illuminate\Support\Facades\DB::transaction(function () use ($booking) {
            $booking->status = 'used';
            $booking->save();
        });
        
        return response()->json([
            'valid' => true,
            'message' => 'Tiket Valid! Penumpang dipersilakan masuk.',
            'passenger' => $booking->user->name,
            'route' => $booking->schedule->route->origin . ' - ' . $booking->schedule->route->destination,
            'bus' => $booking->schedule->bus->name
        ]);
    }
}
