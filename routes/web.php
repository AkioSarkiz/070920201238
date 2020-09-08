<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AddressController::class, 'index'])->name('settings.show');
Route::post('/settings-update', [AddressController::class, 'handleSettings'])->name('settings.update');
Route::post('/del-address', [AddressController::class, 'deleteAddress'])->name('settings.del_address');
