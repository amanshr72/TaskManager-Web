<?php

use App\Events\TaskCreated;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/dashboard', [TaskController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    /* User Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    /* Task */
    Route::resource('task', TaskController::class);
    Route::get('task-list', [TaskController::class, 'allTaskList'])->name('task.allTaskList');
    Route::get('task-assigned', [TaskController::class, 'assignedToMe'])->name('task.assignedToMe');
    Route::get('important', [TaskController::class, 'importantTask'])->name('important');
    Route::get('markImportant/{task}', [TaskController::class, 'markImportant'])->name('task.markImportant');
    Route::get('unmarkImportant/{task}', [TaskController::class, 'unmarkImportant'])->name('task.unmarkImportant');
    Route::get('search', [TaskController::class, 'search']);
    Route::get('filter', [TaskController::class, 'filter']);
    Route::get('category-filter', [TaskController::class, 'categoryFilter']);

    /* Category */
    Route::resource('category', TaskCategoryController::class);

    /* Notification */
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/all-notifications', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-unread', [NotificationController::class, 'markAllAsUnread'])->name('notifications.markAllAsUnread');
    Route::get('reminder', [TaskController::class, 'checkReminderAndSendNotification'])->name('task.reminder');

});

require __DIR__.'/auth.php';
