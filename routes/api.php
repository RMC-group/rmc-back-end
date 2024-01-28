<?php

use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\CustomerControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//user routes
Route::post('/register', [AuthControllers::class, 'registerUser'])->name('registerUser');
Route::get('/logout', [AuthControllers::class, 'logout'])->name('logout');
Route::get('/getAllUser', [AuthControllers::class, 'getAllUser']);
Route::get('/userDetails', [AuthControllers::class, 'userDetails'])->name('userDetails');
Route::put('/userUpdate/{id}', [AuthControllers::class, 'userUpdate'])->name('userUpdate');
Route::post('/login', [AuthControllers::class, 'login'])->name('login');
Route::delete('/delete/{id}', [AuthControllers::class, 'userDelete'])->name('userDelete');


//customer routes
Route::get('customer/getAll', [CustomerControllers::class, 'getAllCustomer']);
Route::get('customer/search/{id}', [CustomerControllers::class, 'searchCustomer']);
Route::post('customer/save', [CustomerControllers::class, 'saveCustomer']);
Route::put('customer/update/{id}', [CustomerControllers::class, 'updateCustomer']);
Route::delete('customer/delete/{id}', [CustomerControllers::class, 'delete']);
