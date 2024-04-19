<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\SiteController;
use App\Http\Controllers\backend\InventoryController;
use App\Http\Controllers\backend\RequirementController;
use App\Http\Controllers\backend\BillController;
use App\Http\Controllers\backend\AccountingController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/logout_user', [HomeController::class, 'logout_user'])->name('logout_user');

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Auth::routes();
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/home', [HomeController::class, 'Admin_dashboard'])->name('admin.home');
    Route::post('changepassword', [HomeController::class, 'Password_Change'])->name('changePassword');

    Route::resource('users', UserController::class)->middleware(['user-access:admin']);
    Route::get('users/destory/{id}', [UserController::class, 'destroy'])->name('users.destory')->middleware(['user-access:admin']);

    Route::resource('sites', SiteController::class)->middleware(['user-access:admin']);
    Route::get('sites/destory/{id}', [SiteController::class, 'destroy'])->name('sites.destory')->middleware(['user-access:admin']);

    Route::resource('inventories', InventoryController::class)->middleware(['user-access:admin']);
    Route::get('inventories/destory/{id}', [InventoryController::class, 'destroy'])->name('inventories.destory')->middleware(['user-access:admin']);

    Route::resource('requirements', RequirementController::class);
    Route::get('requirements/list', [RequirementController::class, 'admin_list'])->name('requirements.admin_index');
    Route::get('requirements/destory/{id}', [RequirementController::class, 'destroy'])->name('requirements.destory');
    Route::get('requirements/status/{id}/{status}', [RequirementController::class, 'status'])->name('requirements.status')->middleware(['user-access:admin']);

    Route::resource('bills', BillController::class);
    Route::get('bills/destory/{id}', [BillController::class, 'destroy'])->name('bills.destory');

    Route::resource('accounting', AccountingController::class);
    Route::get('accounting/destory/{id}', [AccountingController::class, 'destroy'])->name('accounting.destory');
});
  
Route::fallback(function () {
    abort(404);
 });

/*------------------------------------------
--------------------------------------------
All Supervisor Routes List
--------------------------------------------
--------------------------------------------*/
// Route::middleware(['auth', 'user-access:supervisor'])->prefix('supervisor')->group(function () {
//     Route::post('changepassword', [HomeController::class, 'Password_Change'])->name('changePassword');
// });

/*------------------------------------------
--------------------------------------------
All Manager Routes List
--------------------------------------------
--------------------------------------------*/
// Route::middleware(['auth', 'user-access:manager'])->prefix('manager')->group(function () {
//     Route::post('changepassword', [HomeController::class, 'Password_Change'])->name('changePassword');
//     Route::resource('requirements', RequirementController::class);
//     Route::get('requirements/destory/{id}', [RequirementController::class, 'destroy'])->name('requirements.destory');
// });

  