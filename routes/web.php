<?php

use App\Http\Controllers\ShortUrlRedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/s/{code}', [ShortUrlRedirectController::class, 'redirect'])
    ->name('short.redirect');

Route::get('{path}', function () {
    return view('app');
})->where('path', '^(?!api.*$).*')->name('app');;
