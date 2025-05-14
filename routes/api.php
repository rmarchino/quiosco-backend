<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);


    Route::apiResource('companies', CompaniesController::class)->names([
        'index'   => 'companies.index',
        'store'   => 'companies.store',
        'show'    => 'companies.show',
        'update'  => 'companies.update',
        'destroy' => 'companies.destroy',
    ]);
    
    Route::apiResource('employees', EmployeesController::class)->names([
        'index'   => 'employees.index',
        'store'   => 'employees.store',
        'show'    => 'employees.show',
        'update'  => 'employees.update',
        'destroy' => 'employees.destroy',
    ]);

});


// Autenticación
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
