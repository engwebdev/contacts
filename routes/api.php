<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

Route::post('/auth/register', [AuthController::class, 'registerUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/companies', [CompanyController::class, 'index'])->name('Company.index');
    Route::post('/company', [CompanyController::class, 'store'])->name('Company.store');
    Route::get('/company/{company}', [CompanyController::class, 'show'])->name('Company.show');
//    Route::put('/company/{company}', [CompanyController::class, 'update'])->name('Company.update');
//    Route::delete('/company/{company}', [CompanyController::class, 'destroy'])->name('Company.destroy');

    Route::get('/contacts', [ContactController::class, 'index'])->name('Contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('Contact.store');
    Route::post('/contacts', [ContactController::class, 'store_all'])->name('Contact.store_all');
    Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('Contact.show');
    Route::get('/contacts/company/{company}', [ContactController::class, 'show_any'])->name('Contact.indexOwen');
    Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('Contact.update');
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('Contact.destroy');
    Route::delete('/contact/detail/{detail}', [ContactController::class, 'destroy_detail'])->name('Contact.destroy_detail');

    Route::get('/search/{keyword}', [SearchController::class, 'search'])->name('Contact.search');

});



// php artisan make:factory DetailsFactory
