<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\bookingController;

Route::get('/', [AdminController::class,'home']);
Route::get('/home', [AdminController::class,'index'])->name('home');
Route::get('/book', function () {
    return view('book');  // You can create a view called 'book.blade.php'
});
Route::get('/create_room', [AdminController::class, 'create_room']);
Route::post('/add_room', [AdminController::class, 'add_room']);
Route::get('/view_room', [AdminController::class, 'view_room']);
Route::get('/room_delete/{id}', [AdminController::class, 'room_delete']);
Route::get('/room_update/{id}', [AdminController::class, 'room_update']);
Route::post('/edit_room/{id}', [AdminController::class, 'edit_room'])->name('edit_room');
Route::get('/room_details/{id}', [AdminController::class, 'room_details']);

Route::get('/manage_employee', [AdminController::class, 'manage_employee']);
 Route::post('/add_employee', [AdminController::class, 'add_employee']);

 Route::get('/view_employee', [AdminController::class, 'view_employee']);
 Route::get('/employee_delete/{id}', [AdminController::class, 'employee_delete']);
Route::get('/employee_update/{id}', [AdminController::class, 'employee_update']);
Route::post('/edit_employee/{id}', [AdminController::class, 'edit_employee'])->name('edit_employee');


 Route::get('/add_salary', [AdminController::class, 'showAddSalaryForm']);
Route::post('/add_salary', [AdminController::class, 'storeSalary']);

Route::get('/salaries', [AdminController::class, 'viewSalaries']);
Route::post('/add_booking/{id}', [BookingController::class, 'add_booking']);
Route::get('/view_reservations', [AdminController::class, 'view_reservations']);
Route::get('/delete_booking/{id}', [AdminController::class, 'delete_booking']);
Route::get('/approve_book/{id}', [AdminController::class, 'approve_book']);
Route::get('/reject_book/{id}', [AdminController::class, 'reject_book']);
// Route::post('/book-room', [BookingController::class, 'bookRoom']);