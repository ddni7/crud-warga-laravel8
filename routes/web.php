<?php

use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Route::get('/warga', [EmployeeController::class, 'index'])->name('warga');

Route::get('/tambahwarga', [EmployeeController::class, 'tambahwarga'])->name('tambahwarga');

//tmabh
Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');

//tmpledt
Route::get('/tampildata/{id}', [EmployeeController::class, 'tampildata'])->name('tampildata');

//edtt
Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');
//dlett
Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');