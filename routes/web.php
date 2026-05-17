<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
   return redirect('/attendance');
});

Route::get('/attendance', [AttendanceController::class, 'index']);
Route::get('/attendance/create', [AttendanceController::class, 'create']);
Route::post('/attendance/store', [AttendanceController::class, 'store']);

Route::get('/attendance/{id}/edit', [AttendanceController::class, 'edit']);
Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy']);
