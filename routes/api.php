<?php

use App\Http\Controllers\Api\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('item', [ItemController::class, 'index'])->name('api.item.index');
Route::get('item/unique', [ItemController::class, 'uniqueIndex'])->name('api.item.unique.index');
