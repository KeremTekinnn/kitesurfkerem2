<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Instructor\ClientList;
use App\Livewire\Instructor\ClientReservationList;
use App\Livewire\Instructor\ClientsReservationList;
use App\Livewire\Instructor\ClientReservationEdit;
use App\Livewire\Admin\UserList;
use App\Livewire\Admin\UserReservationList;
use App\Livewire\Admin\UsersReservationList;
use App\Livewire\Admin\RequestList;
use App\Livewire\Client\ReservationList;
use App\Livewire\Client\ReservationCreate;
use App\Livewire\Admin\UserReservationEdit;
use App\Http\Controllers\PaymentController;
use App\Models\Course;
use GuzzleHttp\Client;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = Course::all();
    return view('welcome', compact('products'));
});

Route::get('/dashboard', function () {
    $products = Course::all();
    return view('dashboard', compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin routes
Route::middleware(['auth', 'admin', 'verified'])->group(function () {
// Route for users
    Route::get('users', UserList::class)->name('users');
    Route::get('/user/{userId}/reservations', UserReservationList::class)->name('user.reservations');
    Route::get('/users/reservations', UsersReservationList::class)->name('users.reservations');
    Route::get('/user/reservation/{reservationId}/edit', UserReservationEdit::class)->name('user.reservation.edit');
    Route::get('requests', RequestList::class)->name('requests');
});

//instructor routes
Route::middleware(['auth', 'instructor', 'verified'])->group(function () {
    Route::get('clients', ClientList::class)->name('clients');
    Route::get('/client/{clientId}/reservations', ClientReservationList::class)->name('client.reservations');
    Route::get('/clients/reservations', ClientsReservationList::class)->name('clients.reservations');
    Route::get('/client/reservation/{reservationId}/edit', ClientReservationEdit::class)->name('client.reservation.edit');
});

//client routes
Route::middleware(['auth', 'client', 'verified'])->group(function () {
    Route::get('reservations', ReservationList::class)->name('reservations');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('reservation/create', ReservationCreate::class)->name('reservation.create');
});

Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/success/{token}', [PaymentController::class, 'success'])->name('success');

require __DIR__.'/auth.php';
