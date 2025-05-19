<?php

use App\Http\Controllers\Admin\AdminApplyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Setting\EquipmentSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Equipment\EquipmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ApplyController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
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
    return view('landing');
})->name('landing-page');


Route::get('/login',[AuthController::class,'loginpage'])->name('login-page');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'forgotpasswordpage'])->name('forgot-password-page');
Route::post('/forgot-password', [AuthController::class, 'forgotpassword'])->name('forgot-password');

Route::get('/register', [AuthController::class, 'registerpage'])->name('register-page');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::resource('/equipment', EquipmentController::class)->only(['index', 'create', 'edit', 'destroy', 'store', 'update']);
Route::post('/equipment/update', [EquipmentController::class, 'update'])->name('equipment.update');
Route::get('/equipment/type/{type}', [EquipmentController::class, 'viewByType'])->name('equipment.type');
Route::get('/user/equipment', [EquipmentController::class, 'userIndex'])->name('user.equipment.index');

Route::resource('/application', ApplyController::class)->only(['index', 'create', 'edit', 'destroy', 'store', 'update']);
Route::get('/equipment/by-type/{type}', [EquipmentController::class, 'getByType']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('application', AdminApplyController::class)->only([
        'index',
        'create',
        'edit',
        'destroy',
        'store',
        'update'
    ]);
});

Route::resource('/settings-equipment', EquipmentSettingController::class)->only(['index', 'create', 'edit', 'destroy', 'store', 'update']);

Route::resource('/user', UserController::class)->only(['index', 'create', 'edit', 'destroy', 'store', 'update']);

Route::get('/profile', [ProfileController::class, 'profilePage'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/reset-password', [ProfileController::class, 'resetPasswordPage'])->name('profile.reset-password');
Route::post('/profile/reset-password', [ProfileController::class, 'resetPassword'])->name('profile.reset-password.submit');

Route::resource('/settings-admin', AdminController::class);

