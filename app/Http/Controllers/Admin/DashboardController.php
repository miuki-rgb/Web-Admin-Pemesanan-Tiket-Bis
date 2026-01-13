<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Calculate Revenue (Total from confirmed/paid bookings)
        $revenue = Booking::whereIn('status', ['paid', 'confirmed'])->sum('total_price');

        // 2. Recent Bookings (Last 5)
        $recentBookings = Booking::with(['user', 'schedule.route'])
            ->latest()
            ->take(5)
            ->get();

        // 3. Occupancy Rate (Simplistic calculation: Booked Seats / Total Capacity of Active Schedules)
        // This is a rough estimate. For a specific period, we'd filter schedules by date.
        $totalCapacity = Schedule::where('is_active', true)
            ->join('buses', 'schedules.bus_id', '=', 'buses.id')
            ->sum('buses.capacity');

        $totalBooked = Booking::whereIn('status', ['paid', 'confirmed', 'pending']) // Pending also reserves a seat usually
            ->sum('quantity');

        $occupancyRate = $totalCapacity > 0 ? ($totalBooked / $totalCapacity) * 100 : 0;

        // 4. Count stats
        $totalBuses = Bus::count();
        $totalRoutes = \App\Models\Route::count();

        return view('admin.dashboard', compact(
            'revenue', 
            'recentBookings', 
            'occupancyRate', 
            'totalBuses', 
            'totalRoutes'
        ));
    }
}
