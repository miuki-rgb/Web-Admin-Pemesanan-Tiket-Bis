<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\RouteController as AdminRouteController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\BookingController;

// Public Routes
Route::get('/', [BookingController::class, 'search'])->name('home');
Route::get('/search', [BookingController::class, 'search'])->name('bookings.search');

// Authenticated Routes (Customers & Admins)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer Booking Routes
    Route::get('/booking/create/{schedule}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking/store/{schedule}', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/booking/payment/{booking}', [BookingController::class, 'payment'])->name('bookings.payment');
    Route::post('/booking/payment/{booking}', [BookingController::class, 'processPayment'])->name('bookings.process-payment');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my-bookings');
    
    // Redirect /dashboard based on role
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('bookings.my-bookings');
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Master Data
    Route::resource('buses', BusController::class);
    Route::resource('routes', AdminRouteController::class);
    Route::resource('schedules', ScheduleController::class);
    
    // Booking Management
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/verify', [AdminBookingController::class, 'verifyPayment'])->name('bookings.verify');
    
    // Ticket Scanning
    Route::get('/scan-ticket', [AdminBookingController::class, 'showScanner'])->name('scanner');
    Route::post('/scan-ticket', [AdminBookingController::class, 'scanTicket'])->name('scan-ticket');
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
    Route::get('/reports/pdf', [ReportController::class, 'printPdf'])->name('reports.pdf');
});

require __DIR__.'/auth.php';