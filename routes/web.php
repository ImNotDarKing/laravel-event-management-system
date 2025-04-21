<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [EventController::class,'index'])->name('home');
Route::get('/events/{event}', [EventController::class,'show'])->name('events.show');

Route::middleware('auth')->group(function(){
    // Visitor actions
    Route::post('/events/{id}/attend', [AttendanceController::class,'store'])
         ->name('events.attend');

    // Organizer panel
    Route::prefix('organizer')->middleware('role:organizer')->name('organizer.')->group(function(){
        Route::get('events',         [OrganizerController::class,'index'])->name('events.index');
        Route::get('events/create',  [OrganizerController::class,'create'])->name('events.create');
        Route::post('events',        [OrganizerController::class,'store'])->name('events.store');
        Route::get('events/{event}/edit', [OrganizerController::class,'edit'])->name('events.edit');
        Route::put('events/{event}',      [OrganizerController::class,'update'])->name('events.update');
        Route::delete('events/{event}',   [OrganizerController::class,'destroy'])->name('events.destroy');
    });

    // Admin panel
    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function(){
        Route::get('events',            [AdminController::class,'index'])->name('events.index');
        Route::post('events/{id}/status',[AdminController::class,'updateStatus'])->name('events.status');
        Route::delete('events/{id}',    [AdminController::class,'destroy'])->name('events.destroy');
    });
    Auth::routes();
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
