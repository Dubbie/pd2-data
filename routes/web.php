<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\StatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/stat', [StatController::class, 'index'])->name('stat.index');
Route::get('/property', [PropertyController::class, 'index'])->name('property.index');

Route::get('/item/base', [ItemController::class, 'baseItems'])->name('item.base.index');
Route::get('/item/base/{item}', [ItemController::class, 'showBaseItem'])->name('item.base.show');

Route::get('/item/unique', [ItemController::class, 'uniqueItems'])->name('item.unique.index');
Route::get('/item/unique/{item}', [ItemController::class, 'showUniqueItem'])->name('item.unique.show');
