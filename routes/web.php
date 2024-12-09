<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/dashboard-page', [DashboardController::class, 'create'])->name('dashboard-page');
 
});

Route::post('branch-add-edit', [BranchController::class, 'add_edit_branch'])->name('add_edit_branch');
Route::post('branch-list', [BranchController::class, 'branch_list'])->name('branch_list');
Route::get('branch-master', [BranchController::class, 'branch_index']);
Route::post('branch-details', [BranchController::class, 'branch_details'])->name('branch_details');;
Route::post('branch-remove', [BranchController::class, 'branch_remove']);

Route::get('order-master', [OrderController::class, 'order_index']);
Route::post('order-add', [OrderController::class, 'order_add'])->name('order-add');
Route::post('order-update', [OrderController::class, 'order_update'])->name('order-update');
Route::post('order-list', [OrderController::class, 'order_list'])->name('order_list');
Route::post('order-details', [OrderController::class, 'order_details'])->name('order_details');
Route::post('order-remove', [OrderController::class, 'order_remove']);

Route::get('user-master', [UserController::class, 'user_index']);
Route::post('user-add-edit', [UserController::class, 'user_add_edit']);
Route::post('user-list', [UserController::class, 'user_list'])->name('user-list');
Route::post('user-details', [UserController::class, 'user_details']);
Route::post('user-remove', [UserController::class, 'user_remove']);


Route::post('role-add-edit', [UserController::class, 'role_add_and_edit']);
Route::post('role-details', [UserController::class, 'role_details']);
Route::post('role-list', [UserController::class, 'role_list']);
Route::post('role-remove', [UserController::class, 'role_remove']);



require __DIR__.'/auth.php';
