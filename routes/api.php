<?php

use App\Http\Controllers\Api\MidtransController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/midtrans-callback', [BookingController::class, 'callback']);
