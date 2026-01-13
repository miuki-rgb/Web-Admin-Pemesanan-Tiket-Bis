<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        $bookings = Booking::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->whereIn('status', ['paid', 'confirmed'])
            ->with(['user', 'schedule.route'])
            ->latest()
            ->get();

        $totalRevenue = $bookings->sum('total_price');

        return view('admin.reports.index', compact('bookings', 'startDate', 'endDate', 'totalRevenue'));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $bookings = Booking::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->whereIn('status', ['paid', 'confirmed'])
            ->with(['user', 'schedule.route'])
            ->get();

        $fileName = 'revenue_report_' . $startDate . '_to_' . $endDate . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Date', 'Booking ID', 'Customer', 'Route', 'Amount', 'Status');

        $callback = function() use($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $booking) {
                $row['Date']  = $booking->created_at->format('Y-m-d H:i');
                $row['Booking ID']    = $booking->id;
                $row['Customer']    = $booking->user->name;
                $row['Route']  = $booking->schedule->route->origin . ' - ' . $booking->schedule->route->destination;
                $row['Amount']  = $booking->total_price;
                $row['Status']  = $booking->status;

                fputcsv($file, array($row['Date'], $row['Booking ID'], $row['Customer'], $row['Route'], $row['Amount'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function printPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $bookings = Booking::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->whereIn('status', ['paid', 'confirmed'])
            ->with(['user', 'schedule.route'])
            ->get();
            
        $totalRevenue = $bookings->sum('total_price');

        return view('admin.reports.print', compact('bookings', 'startDate', 'endDate', 'totalRevenue'));
    }
}
