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
Route::any('/vehicle_service_pdf/{id}', [App\Http\Controllers\VehicleController::class, 'vehicle_service_pdf'])->name('vehicle_service_pdf');
Route::any('/vehicle_usage_pdf/{id}', [App\Http\Controllers\VehicleController::class, 'vehicle_usage_pdf'])->name('vehicle_usage_pdf');

Route::any('/register_usage/{id}', [App\Http\Controllers\VehicleUsageController::class, 'register_usage'])->name('register_usage');
Route::any('/save_usage', [App\Http\Controllers\VehicleUsageController::class, 'save_usage'])->name('save_usage');

Route::any('/register_service/{id}', [App\Http\Controllers\VehicleUsageController::class, 'register_service'])->name('register_service');
Route::any('/save_service', [App\Http\Controllers\VehicleUsageController::class, 'save_service'])->name('save_service');

Route::any('/service_classes/index', [App\Http\Controllers\ServiceClassesController::class, 'index'])->name('service_classes.index');
Route::any('/service_classes/create', [App\Http\Controllers\ServiceClassesController::class, 'create'])->name('service_classes.create');
Route::any('/service_classes/store', [App\Http\Controllers\ServiceClassesController::class, 'store'])->name('service_classes.store');
Route::any('/service_classes/edit/{id}', [App\Http\Controllers\ServiceClassesController::class, 'edit'])->name('service_classes.edit');
Route::any('/service_classes/update', [App\Http\Controllers\ServiceClassesController::class, 'update'])->name('service_classes.update');
Route::any('/service_classes/delete/{id}', [App\Http\Controllers\ServiceClassesController::class, 'delete'])->name('service_classes.delete');

Route::any('/vehicle_usages_report', [App\Http\Controllers\VehicleReportsController::class, 'vehicle_usages_report'])->name('vehicle_usages_report');
Route::any('/vehicle_services_report', [App\Http\Controllers\VehicleReportsController::class, 'vehicle_services_report'])->name('vehicle_services_report');
