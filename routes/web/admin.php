<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Employee;
use App\Models\User;

/*
|----------------------------------------------------------------

                    ROUTES FOR ADMIN TYPE
                    PREFIXED WITH /admin/{your link}

|----------------------------------------------------------------
*/


/*
-------------------USER ROUTES--------------------------
*/
Route::get('/get_users', [UserController::class, 'getUsers']);
Route::get('/get_user/{user_id}', [UserController::class, 'getUser']);
Route::post('/user_update/{user_id}', [UserController::class, 'update']);
Route::delete('/user_destroy/{user_id}', [UserController::class, 'destroy']);
Route::get('/get_roles', [UserController::class, 'getRoles']);

/*
-------------------EMPLOYEES ROUTES--------------------------
*/
Route::get('/employees_get', [EmployeeController::class, 'getEmployees']);
Route::get('/get_posts', [PostController::class, 'getPosts']);
Route::post('/store_empl', [EmployeeController::class, 'storeEmpl']);


