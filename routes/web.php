<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProfesorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('profesores', ProfesorController::class);
Route::resource('reservas', ReservaController::class);
