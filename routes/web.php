<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SortController;

Route::get('/', [SortController::class, 'menu'])->name('sort.index');
Route::post('/sort', [SortController::class, 'sortNumbers'])->name('sort.numbers');
Route::get('/download', [SortController::class, 'download'])->name('sort.download');
Route::get('/result', [SortController::class, 'result'])->name('sort.result');
Route::get('/input-angka', [SortController::class, 'inputAngka'])->name('sort.input-angka');
Route::get('/clear-sort-number', [SortController::class, 'clearSortNumber'])->name('sort.clear-sort-number');
