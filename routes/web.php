<?php

use App\Http\Livewire\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProductShow;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::get('/products',Products::class)->name('products.index');
    Route::get('/products/{id}', ProductShow::class)->name('products.show');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
