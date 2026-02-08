<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Resource routes for CRUD
Route::resource('categories', CategoryController::class);
Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);
Route::resource('borrowings', BorrowingController::class);

// Additional borrowing routes
Route::post('borrowings/{borrowing}/return', [BorrowingController::class, 'returnBooks'])
    ->name('borrowings.return');

