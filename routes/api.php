<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public Routes
Route::get('/schedules', [MainController::class, 'getSchedules']);
Route::get('/announcements', [MainController::class, 'getAnnouncements']);
Route::get('/locations', [MainController::class, 'getLocations']);
Route::get('/announcement-image/{filename}', [MainController::class, 'serveImage']);
Route::get('/profile-image/{filename}', [MainController::class, 'serveProfileImage']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/profile', [AuthController::class, 'updateProfile']); // Changed to POST for multipart support
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    Route::post('/bookings', [MainController::class, 'storeBooking']);
    Route::get('/my-tickets', [MainController::class, 'getMyTickets']);
    Route::post('/scan-ticket', [MainController::class, 'scanTicket']);
});