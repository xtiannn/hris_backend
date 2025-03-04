<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\PayrollController;
use App\Http\Controllers\Api\PayslipController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\SalaryController;
use App\Models\Attendance;
use App\Models\Payroll;
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



# Endpoint: Department
# HTTP METHOD: GET
Route::get('/departments', [DepartmentController::class, 'index']); // GET ALL
Route::post('/departments', [DepartmentController::class, 'store']); // Create
Route::get('/departments/{department}', [DepartmentController::class, 'show']); // Get Department by ID
Route::put('/departments/{department}', [DepartmentController::class, 'update']);
Route::delete('/departments/{department}', [DepartmentController::class, 'destroy']);


# DESIGNATION Management
Route::get('/designations', [DesignationController::class, 'index']);
Route::post('/designations', [DesignationController::class, 'store']); // Create
Route::get('/designations/{designation}', [DesignationController::class, 'show']); // Get Department by ID
Route::put('/designations/{designation}', [DesignationController::class, 'update']);
Route::delete('/designations/{designation}', [DesignationController::class, 'destroy']);


# ATTENDANCE Management
Route::get('/attendances', [AttendanceController::class, 'index']);
Route::post('/attendances', [AttendanceController::class, 'store']); // Create
Route::get('/attendances/{attendance}', [AttendanceController::class, 'show']); // Get Department by ID
Route::put('/attendances/{attendance}', [AttendanceController::class, 'update']);
Route::delete('/attendances/{attendance}', [AttendanceController::class, 'destroy']);


# Payroll Management
Route::get('/payrolls', [PayrollController::class, 'index']);
Route::post('/payrolls', [PayrollController::class, 'store']); // Create
Route::get('/payrolls/{payroll}', [PayrollController::class, 'show']); // Get Department by ID
Route::put('/payrolls/{payroll}', [PayrollController::class, 'update']);
Route::delete('/payrolls/{payroll}', [PayrollController::class, 'destroy']);


# PAYSLIP Management
Route::get('/payslips', [PayslipController::class, 'index']);
Route::post('/payslips', [PayslipController::class, 'store']); // Create
Route::get('/payslips/{payslip}', [PayslipController::class, 'show']); // Get Department by ID
Route::put('/payslips/{payslip}', [PayslipController::class, 'update']);
Route::delete('/payslips/{payslip}', [PayslipController::class, 'destroy']);
