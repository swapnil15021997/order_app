<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Settings;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $login = auth()->user()->toArray();
    $role = UserRole::get_role_by_id($login['user_role_id']);
    $login['role_name'] = $role->role_name;
    if (!empty($login)) {

        if ($login['user_role_id'] != 1) {

            $userBranchIds = explode(',', $login['user_branch_ids']);
            $userBranchIds = array_map('trim', $userBranchIds);
            $userBranchIds = array_filter($userBranchIds);
            if (!empty($userBranchIds)) {

                $users_branch = Branch::get_users_branch($userBranchIds);
            } else {
                $users_branch = [];
            }

        } else {
            $users_branch = Branch::get_all_branch();

        }

        if (!empty($users_branch)) {

            foreach ($users_branch as $branch) {
                if ($branch['branch_id'] == $login['user_active_branch']) {
                    $activeBranchName = $branch['branch_name'];
                    break;
                } else {
                    $activeBranchName = '';
                }
            }
        } else {
            $activeBranchName = '';
        }

    } else {
        $activeBranchName = '';
    }

    session(['active_branch' => $activeBranchName]);
    session(['role_name' => $role->role_name]);
    session(['profile_path' => $login['user_profile']]);


    $branch_count = Branch::where('is_delete', 0)->count();
    $user_count = User::where('is_delete', 0)->count();
    $orders_count = Order::where('is_delete', 0)->count();
    $total_role = UserRole::whereNull('deleted_at')->count();
    $order = Order::get_latest_order();
    $branch = Branch::get_latest_branch();

    $user_permission = isset($login['user_permission_id']) ? explode(',', $login['user_permission_id']) : [];
    $role = UserRole::whereNull('deleted_at')->where('role_id', $login['user_role_id'])->first()->toArray();

    $role_permission = [];
    if (!empty($role)) {
        $role_permission = isset($role['role_permission_ids']) ? explode(',', $role['role_permission_ids']) : [];
    }
    $combined_permissions = array_unique(array_merge((array) $user_permission, (array) $role_permission));

    session(['combined_permissions' => $combined_permissions]);
    $activePage = 'home';
    return view('index_new', [
        'login' => $login,
        'activePage' => 'dashboard',
        'user_branch' => $users_branch,
        'order_count' => $orders_count,
        'user_count' => $user_count,
        'branch_count' => $branch_count,
        'total_role' => $total_role,
        'order' => $order,
        'branch' => $branch,
        'user_permissions' => $combined_permissions,
        'activeBranchName' => $activeBranchName,
        'activePage' => $activePage
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile-update', [ProfileController::class, 'user_update'])->name('user_update');


});

Route::middleware('guest')->group(function () {
    Route::get('/dashboard-page', [DashboardController::class, 'create'])->name('dashboard-page');

});

Route::middleware('auth')->group(function () {
    Route::post('branch-add-edit', [BranchController::class, 'add_edit_branch'])->name('add_edit_branch');
    Route::post('branch-list', [BranchController::class, 'branch_list'])->name('branch_list');
    Route::get('branch-master', [BranchController::class, 'branch_index'])->name('branch-master');
    Route::post('branch-details', [BranchController::class, 'branch_details'])->name('branch_details');
    ;
    Route::post('branch-remove', [BranchController::class, 'branch_remove'])->name('branch_remove');
    Route::post('branch-active', [BranchController::class, 'change_active_branch'])->name('branch-active');

    Route::post('customer-add-edit', [CustomerController::class, 'add_edit_customer'])->name('add_edit_cust');
    Route::post('customer-list', [CustomerController::class, 'customer_list'])->name('customer_list');


    Route::get('/order-add', [OrderController::class, 'order_add_page'])->name('order-add-page');
    Route::get('edit-order/{id}', [OrderController::class, 'order_edit_page'])->name('order_edit_page');



    Route::get('order-master', [OrderController::class, 'order_index'])->name('order-master');
    Route::post('order-add', [OrderController::class, 'order_add'])->name('order-add');
    Route::post('order-update', [OrderController::class, 'order_update'])->name('order-update');
    Route::post('order-list', [OrderController::class, 'order_list'])->name('order_list');
    Route::post('order-details', [OrderController::class, 'order_details'])->name('order_details');
    Route::post('order-remove', [OrderController::class, 'order_remove'])->name('order_remove');
    Route::get('qr-code/{id}', [OrderController::class, 'order_qr_code'])->name('order_qr_code');
    Route::post('order-transfer', [OrderController::class, 'order_transfer'])->name('order_transfer');
    Route::get('track-order/{id}', [OrderController::class, 'track_order'])->name('track_order');
    Route::post('qr-details', [OrderController::class, 'qr_details'])->name('qr_details');
    Route::post('custom-save', [OrderController::class, 'custom_save'])->name('custom_save');

    Route::post('multiple-approve', [OrderController::class, 'multiple_approve'])->name('multiple_approve');
    Route::post('multiple-transfer', [OrderController::class, 'multiple_transfer'])->name('multiple_transfer');

    Route::post('transfer-list', [TransferController::class, 'transfer_list'])->name('transfer-list');
    Route::get('transfer-master', [TransferController::class, 'transfer_index'])->name('transfer-master');
    Route::get('view-receipt/{id}', [TransferController::class, 'view_receipt'])->name('view_receipt');
    Route::get('transfer-receipt/{id}', [TransferController::class, 'transfer_receipt'])->name('transfer_receipt');

    Route::get('user-master', [UserController::class, 'user_index'])->name('user-master');
    Route::get('user-add', [UserController::class, 'user_add'])->name('user-add');
    Route::get('edit-user/{user_id}', [UserController::class, 'edit_user']);

    Route::post('user-add-edit', [UserController::class, 'user_add_edit'])->name('user_add_edit');
    Route::post('user-list', [UserController::class, 'user_list'])->name('user-list');
    Route::post('user-details', [UserController::class, 'user_details'])->name('user_details');
    Route::post('user-remove', [UserController::class, 'user_remove'])->name('user_remove');


    Route::get('role-master', [UserController::class, 'role_index'])->name('role-master');
    Route::get('role-add', [UserController::class, 'role_add'])->name('role-add');
    Route::get('edit-role/{role_id}', [UserController::class, 'edit_role']);
    Route::post('role-add-edit', [UserController::class, 'role_add_and_edit'])->name('role_add_and_edit');
    Route::post('role-details', [UserController::class, 'role_details'])->name('role-details');
    Route::post('role-list', [UserController::class, 'role_list'])->name('role-list');
    Route::post('role-remove', [UserController::class, 'role_remove'])->name('role_remove');


    Route::post('notes-add', [NotesController::class, 'add_notes'])->name('notes_add');
    Route::post('notes-details', [NotesController::class, 'notes_details'])->name('notes_details');
    Route::post('notes-remove', [NotesController::class, 'notes_remove'])->name('notes_remove');
    Route::post('notes-list', [NotesController::class, 'notes_list'])->name('notes_list');

    Route::get('settings', [ProfileController::class, 'get_settings'])->name('settings');
    
    // PRDIP ROUTES FOR SAVING & REMOVING METAL, MELTING & COLOR
    Route::post('save-mmc', [ProfileController::class, 'save_mmc'])->name('save.mmc');
    Route::post('delete-mmc', [ProfileController::class, 'delete_mmc'])->name('delete.mmc');

    Route::post('password', [PasswordController::class, 'update'])->name('password.update');


    Route::post('order-approve', [OrderController::class, 'order_approve'])->name('order_approve');
    Route::get('view-order/{id}', [OrderController::class, 'view_order'])->name('view-order');
    Route::get('order-approve/{id}', [OrderController::class, 'order_get_approve'])->name('order_get_approve');


    Route::post('file-remove', [NotesController::class, 'file_remove'])->name('file_remove');

    // Activity Log Routes
    Route::get('activity-master', [ActivityController::class, 'activity_index'])->name('activity-master');
    Route::post('activity-list', [ActivityController::class, 'activity_list'])->name('activity_list');


});


Route::get('success', [OrderController::class, 'success'])->name('success');


Route::get('firebase_json.js', [DashboardController::class, 'firebase_config']);
Route::post('update-fcm', [DashboardController::class, 'update_fcm'])->name('update-fcm');


Route::get('test', [OrderController::class, 'test'])->name('test');

Route::get('item-list', [OrderController::class, 'item_list'])->name('item_list');
require __DIR__ . '/auth.php';
