<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserAuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// UserAuthController  Routes
Route::post('/login', [UserAuthController::class, 'login'])->name('users.login');
Route::post('/signup', [UserAuthController::class, 'signup'])->name('users.signup');

// middleware
Route::group(['middleware' => 'auth:sanctum'], function () {
    // StudentController Routes
    Route::get('/students', [StudentController::class, 'listOfStudent'])->name('students.listOfStudent');

    Route::post('/addStudent', [StudentController::class, 'addStudent'])->name('students.addStudent');

    Route::put('/updateStudent', [StudentController::class, 'updateStudent'])->name('students.updateStudent');

    Route::delete('/deleteStudent/{id}', [StudentController::class, 'deleteStudent'])->name('students.deleteStudent');

    Route::get('/searchStudent/{name}', [StudentController::class, 'searchStudent'])->name('students.searchStudent');
});


// Handing 500 - internal server error by showing the login function message. But this time with get() method.
Route::get('/login', [UserAuthController::class, 'login'])->name('login');