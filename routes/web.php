<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::resource('users', App\Http\Controllers\UserController::class);
