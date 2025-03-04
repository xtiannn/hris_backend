<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\SalaryController;
use Illuminate\Support\Facades\Route;


// Route::apiResource('products', ProductController::class);
// Route::apiResource('users', UserController::class);
// Route::middleware('auth:sanctum')->apiResource('employees', EmployeeController::class);

# GET Current User
Route::get('/authenticated-current-user', [UserController::class, 'getCurrentUser']);

Route::get('/user/profile', [UserController::class, 'userProfile']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/check-email', [UserController::class, 'checkEmail']);

# USER Management
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

# EMPLOYEE Management
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
Route::put('/employees/{employee}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
Route::get('/users-doesnt-have-employee', [EmployeeController::class, 'usersDoesntHaveEmployee']);

# SALARY Management
Route::get('/salary', [SalaryController::class, 'index']);
Route::post('/salary', [SalaryController::class, 'store']);
Route::get('/salary/{salary}', [SalaryController::class, 'show']);
Route::put('/salary/{salary}', [SalaryController::class, 'update']);
Route::delete('/salary/{id}', [SalaryController::class, 'destroy']);


# AUTHENTICATION



# DEPARTMENT Management
Route::get('/departments', [DepartmentController::class, 'index']);

# DESIGNATION Management
Route::get('/designations', [DesignationController::class, 'index']);
