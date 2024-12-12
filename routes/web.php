<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Branch;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $login = auth()->user()->toArray();
    if(!empty($login)){
        $userBranchIds = explode(',', $login['user_branch_ids']);
    }
    $users_branch = Branch::whereIn('branch_id', $userBranchIds)->get()->toArray();
    return view('index_new',['login'=>$login,'activePage'=>'dashboard','user_branch'=>$users_branch]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/dashboard-page', [DashboardController::class, 'create'])->name('dashboard-page');
 
});

Route::middleware('auth')->group(function () {
Route::post('branch-add-edit', [BranchController::class, 'add_edit_branch'])->name('add_edit_branch');
Route::post('branch-list', [BranchController::class, 'branch_list'])->name('branch_list');
Route::get('branch-master', [BranchController::class, 'branch_index'])->name('branch-master');
Route::post('branch-details', [BranchController::class, 'branch_details'])->name('branch_details');;
Route::post('branch-remove', [BranchController::class, 'branch_remove'])->name('branch_remove');
Route::post('branch-active', [BranchController::class, 'change_active_branch'])->name('branch-active');


Route::get('order-add', [OrderController::class, 'order_add_page'])->name('order-add-page');
Route::get('edit-order/{id}', [OrderController::class, 'order_edit_page'])->name('order_edit_page');


Route::get('order-master', [OrderController::class, 'order_index'])->name('order-master');
Route::post('order-add', [OrderController::class, 'order_add'])->name('order-add');
Route::post('order-update', [OrderController::class, 'order_update'])->name('order-update');
Route::post('order-list', [OrderController::class, 'order_list'])->name('order_list');
Route::post('order-details', [OrderController::class, 'order_details'])->name('order_details');
Route::post('order-remove', [OrderController::class, 'order_remove'])->name('order_remove');

Route::get('user-master', [UserController::class, 'user_index'])->name('user-master');
Route::get('user-add', [UserController::class, 'user_add'])->name('user-add');
Route::get('edit-user/{user_id}', [UserController::class, 'edit_user']);

Route::post('user-add-edit', [UserController::class, 'user_add_edit'])->name('user_add_edit');
Route::post('user-list', [UserController::class, 'user_list'])->name('user-list');
Route::post('user-details', [UserController::class, 'user_details']);
Route::post('user-remove', [UserController::class, 'user_remove'])->name('user_remove');


Route::get('role-master', [UserController::class, 'role_index'])->name('role-master');
Route::get('role-add', [UserController::class, 'role_add'])->name('role-add');
Route::get('edit-role/{role_id}', [UserController::class, 'edit_role']);
Route::post('role-add-edit', [UserController::class, 'role_add_and_edit'])->name('role_add_and_edit');
Route::post('role-details', [UserController::class, 'role_details'])->name('role-details');
Route::post('role-list', [UserController::class, 'role_list'])->name('role-list');
Route::post('role-remove', [UserController::class, 'role_remove']);

});

require __DIR__.'/auth.php';
