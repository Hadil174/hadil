<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaypalController;
use App\Models\AlternativeService; // ✅ CORRECT





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
Route::post('/contact', [AdminController::class, 'contact']);
Route::get('/all_messages', [AdminController::class, 'all_messages']);
Route::get('/list_room', [ReceptionistController::class, 'list_room']);
Route::get('/list_booking', [ReceptionistController::class, 'list_booking']);


Route::get('receptionist/checkin/{id}', [ReceptionistController::class, 'checkin']);
Route::get('receptionist/checkout/{id}', [ReceptionistController::class, 'checkout']);
Route::get('/delete_booking/{id}', [ReceptionistController::class, 'delete_booking']);

Route::get('/showForm/{id}', [BookingController::class, 'showForm']);
Route::get('/book_room/{id}', [BookingController::class, 'book_room']);
Route::get('/room/status/{id}', [ReceptionistController::class, 'manageRoomStatus'])->name('room.status');

// POST - handle form submit
Route::post('/room/status/{id}', [ReceptionistController::class, 'updateRoomStatus'])->name('room.status.update');
// Make sure you have this route (adjust controller name if needed)
Route::get('/today_checkins', [ReceptionistController::class, 'todayCheckins'])->name('today_checkins');
Route::get('/today_checkouts', [ReceptionistController::class, 'todayCheckouts'])->name('today_checkouts');
Route::get('/guest/services', [GuestController::class, 'showServices'])->middleware('auth');

    
// View and manage additional services
Route::get('services', [ReceptionistController::class, 'viewRequestedServices'])->name('services.index');

// Store a new service request (for a guest)
Route::post('services', [ReceptionistController::class, 'createNewServiceRequest'])->name('services.store');

// View the details of a specific service request (optional, can be modal details)
Route::get('services/{id}', [ReceptionistController::class, 'viewServiceDetails'])->name('services.show');
Route::get('request_service', [GuestController::class, 'showRequestForm'])->name('guest.services.create');

// Route to handle the service request submission
Route::post('request_service', [GuestController::class, 'storeRequest'])->name('guest.services.store');
Route::post('/notifications/{id}/read', function ($id) {
    auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    return response()->noContent();
});
Route::get('/notification', [ReceptionistController::class, 'all_service_requests'])->name('receptionist.notifications');


Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');
Route::get('success', [PaypalController::class, 'success'])->name('success');
Route::get('cancel',[PaypalController::class,'cancel'])->name('cancel');


