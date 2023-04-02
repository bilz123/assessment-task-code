<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false, 'confirm' => false]);

// since, we don't have front site, we redirect to login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    // dashboard
    Route::get('/dashboard', [Controllers\HomeController::class, 'index'])->name('home');

    //Event Controller
    Route::resource('events', Controllers\EventController::class)->except(['show']);
    Route::get('/events-dt', [Controllers\EventController::class, 'datatable'])->name('events-dt');

    //google calendar
    Route::get('/google-calendar', [Controllers\CalendarController::class, 'index'])->name('/google-calendar');
    Route::get('calendar-event', [Controllers\CalendarController::class, 'index']);
    Route::post('calendar-crud-ajax', [Controllers\CalendarController::class, 'calendarEvents']);
});
