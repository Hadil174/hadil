<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HousekeepingController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/create_room', [AdminController::class, 'create_room']);
// Route::prefix('admin')->group(function () {
//     Route::post('/rooms/create', [AdminController::class, 'createRoom']);
//     Route::put('/rooms/{room}', [AdminController::class, 'update']);
//     Route::delete('rooms/{room}', [AdminController::class, 'destroyRoom']);
   
//     Route::get('/employees', [AdminController::class, 'employeeIndex']);
//     Route::post('/employees/create', [AdminController::class, 'employeeStore']);
//     Route::get('/employees/{employee}', [AdminController::class, 'employeeShow']);
//     Route::put('/employees/{employee}', [AdminController::class, 'employeeUpdate']); 
//     Route::delete('/employees/{employee}', [AdminController::class, 'employeeDestroy']);
   
// }





