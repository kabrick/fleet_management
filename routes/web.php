<?php

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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('/register_vehicle', [App\Http\Controllers\VehicleController::class, 'register_vehicle'])->name('register_vehicle');
Route::any('/save_vehicle', [App\Http\Controllers\VehicleController::class, 'save_vehicle'])->name('save_vehicle');
Route::any('/edit_vehicle/{id}', [App\Http\Controllers\VehicleController::class, 'edit_vehicle'])->name('edit_vehicle');
Route::any('/save_vehicle_edits', [App\Http\Controllers\VehicleController::class, 'save_vehicle_edits'])->name('save_vehicle_edits');
Route::any('/delete_vehicle/{id}', [App\Http\Controllers\VehicleController::class, 'delete_vehicle'])->name('delete_vehicle');
Route::any('/vehicle_details/{id}', [App\Http\Controllers\VehicleController::class, 'vehicle_details'])->name('vehicle_details');
