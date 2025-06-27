<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');
Route::patch('/home/{id}', [HomeController::class, 'profileUpdate'])->name('home.user.edit');



Route::get('subscription', [SubscriptionController::class, 'loadSubscription'])->middleware(['auth', 'verified'])->name('subscription');
Route::post('get-plan-details', [SubscriptionController::class, 'getPlanDetails'])->middleware(['auth', 'verified'])->name('getPlanDetails');
// Routes for admin
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login/admin', [AdminController::class, 'login'])->name('admin.login.admin');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware(AdminMiddleware::class);
    Route::get('users', [AdminController::class, 'showUsers'])->name('admin.users')->middleware(AdminMiddleware::class);
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware(AdminMiddleware::class);;
    Route::get('users/{id}', [AdminController::class, 'viewUser'])->name('admin.users_details')->middleware(AdminMiddleware::class);
    Route::get('user/status/{id}', [AdminController::class, 'blockUser'])->name('admin.user.status')->middleware(AdminMiddleware::class);;
    Route::get('blocked_users', [AdminController::class, 'blockedUsers'])->name('admin.pages.blocked_users')->middleware(AdminMiddleware::class);
    Route::get('unverified_users', [AdminController::class, 'unverifiedUsers'])->name('admin.pages.unverified_users')->middleware(AdminMiddleware::class);
    Route::get('active_users', [AdminController::class, 'activeUsers'])->name('admin.pages.active_users')->middleware(AdminMiddleware::class);
    Route::view('charts', 'admin.pages.charts')->name('admin.charts')->middleware(AdminMiddleware::class);
    Route::view('tables', 'admin.pages.tables')->name('admin.tables')->middleware(AdminMiddleware::class);
    Route::view('500', 'admin.pages.500')->name('admin.500')->middleware(AdminMiddleware::class);
    Route::view('401', 'admin.pages.401')->name('admin.401')->middleware(AdminMiddleware::class);
    Route::view('404', 'admin.pages.404')->name('admin.404')->middleware(AdminMiddleware::class);
});



require __DIR__ . '/auth.php';