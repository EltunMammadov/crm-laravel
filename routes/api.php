<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('auth')->controller(AuthController::class)->group(function() {
    Route::post('', 'login')->name('auth.login');
});

Route::middleware('auth:sanctum')->group(function() {

    # Customer
    Route::prefix('customers')->controller(CustomerController::class)->group(function() {
        Route::get('', 'index')->name('customer.index');
        Route::post('', 'create')->name('customer.create');
        Route::prefix('{customer_id}')->group(function() {
            Route::get('', 'read')->name('customer.read');
            Route::patch('', 'update')->name('customer.update');
            Route::delete('', 'delete')->name('customer.delete');
        });
    });

    # Service
    Route::prefix('services')->controller(ServiceController::class)->group(function() {
        Route::get('', 'index')->name('service.index');
        Route::post('', 'create')->name('service.create');
        Route::prefix('{service_id}')->group(function() {
            Route::get('', 'read')->name('service.read');
            Route::put('', 'update')->name('service.update');
            Route::delete('', 'delete')->name('service.delete');
        });
    });

    # ToDo
    Route::prefix('todos')->controller(TodoController::class)->group(function() {
        Route::get('', 'index')->name('todo.index');
        Route::post('', 'create')->name('todo.create');
        Route::prefix('{todo_id}')->group(function() {
            Route::get('', 'read')->name('todo.read');
            Route::get('edit', 'edit')->name('todo.edit');
            Route::patch('', 'update')->name('todo.update');
            Route::delete('', 'delete')->name('todo.delete');
        });
    });
});