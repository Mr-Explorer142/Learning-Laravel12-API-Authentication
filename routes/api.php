<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/students', [StudentController::class, 'listOfStudent'])->name('students.listOfStudent');

Route::post('/addStudent', [StudentController::class, 'addStudent'])->name('students.addStudent');

Route::put('/updateStudent', [StudentController::class, 'updateStudent'])->name('students.updateStudent');

Route::delete('/deleteStudent/{id}', [StudentController::class, 'deleteStudent'])->name('students.deleteStudent');


Route::get('/searchStudent/{name}', [StudentController::class, 'searchStudent'])->name('students.searchStudent');