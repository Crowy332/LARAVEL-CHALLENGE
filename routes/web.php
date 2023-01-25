<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CompanieController;
use App\Http\Controllers\EmployeeController;

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
    return view('/login');
});

Route::get('/', function () {
    return Controller::ViewCompanyPage();
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(Controller::class)->group(function () {
        Route::get('/company', 'ViewCompanyPage')->name('company');
        Route::get('/employee', 'ViewEmployeePage')->name('employee');
    });
    Route::controller(CompanieController::class)->group(function () {
        Route::post('/add_companie', 'store');
        Route::post('/edit_companie', 'edit');
        Route::post('/update_companie', 'update');
        Route::post('/delete_companie', 'destroy');
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::post('/add_employee', 'store');
        Route::post('/edit_employee', 'edit');
        Route::post('/update_employee', 'update');
        Route::post('/delete_employee', 'destroy');
    });
});

require __DIR__.'/auth.php';
