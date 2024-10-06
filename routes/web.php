<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Auth::routes([
    'password.request' => false,   // 404 disabled
    'password.confirm' => false,   // 404 disabled
    'password.update'  => false,   // 404 disabled
    'password.email'   => false,   // 404 disabled
    'password.reset'   => false,   // 404 disabled
]);

Route::name('app.')->middleware('auth')->group(function(){
    // Dashboard Route
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

});
