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
use App\Http\Controllers\NotesController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('auth:sanctum');


Route::post('permission-list', [UserController::class, 'permission_list']);



Route::post('notes-add'    , [NotesController::class, 'add_notes']);
Route::post('notes-details', [NotesController::class, 'notes_details']);
Route::post('notes-remove' , [NotesController::class, 'notes_remove']);
Route::post('notes-list'   , [NotesController::class, 'notes_list']);
