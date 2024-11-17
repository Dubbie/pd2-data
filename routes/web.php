<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\StatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/stat', [StatController::class, 'index'])->name('stat.index');
