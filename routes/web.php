<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route("users.index");
});

Route::resource('users', UserController::class);

Route::resource('leads', LeadController::class);
