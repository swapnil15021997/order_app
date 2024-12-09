<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\OrderController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('auth:sanctum');

Route::post('user-add-edit', [UserController::class, 'user_add_edit']);
Route::post('user-list', [UserController::class, 'user_list']);
Route::post('user-details', [UserController::class, 'user_details']);
Route::post('user-remove', [UserController::class, 'user_remove']);


Route::post('role-add-edit', [UserController::class, 'role_add_and_edit']);
Route::post('role-details', [UserController::class, 'role_details']);
Route::post('role-list', [UserController::class, 'role_list']);
Route::post('role-remove', [UserController::class, 'role_remove']);

Route::post('permission-list', [UserController::class, 'permission_list']);

Route::post('branch-add-edit', [BranchController::class, 'add_edit_branch']);
Route::post('branch-list', [BranchController::class, 'branch_list']);
Route::post('branch-details', [BranchController::class, 'branch_details']);
Route::post('branch-remove', [BranchController::class, 'branch_remove']);

Route::post('order-add', [OrderController::class, 'order_add']);
Route::post('order-list', [OrderController::class, 'order_list']);
Route::post('order-details', [OrderController::class, 'order_details']);
Route::post('order-remove', [OrderController::class, 'order_remove']);
