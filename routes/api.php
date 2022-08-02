<?php

use App\Http\Controllers\PisControllers\FormController;
use App\Http\Controllers\PisControllers\StaffController;
use App\Http\Controllers\PisControllers\TaskController;
use App\Models\SharedModel\SettingValue;
use App\Http\Controllers\YojanaControllers\ApiHelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('position', function () {
    return response()->json(SettingValue::query()->where('setting_id', 15)->get());
});

Route::get('leaveData', [StaffController::class, 'leaveData'])->name('get-total-leave');
Route::get('leave', [StaffController::class, 'leave_approval_details'])->name('leave-approval-details');
Route::get('print-maag', [FormController::class, 'print_maag_details'])->name('print-maag-details');
Route::get('getStaffServices', [FormController::class, 'staffServices'])->name('getStaffServices');
Route::get('get-admin-notifications', [StaffController::class, 'adminNotifications'])->name('api.getAdminNotifications');
Route::get('get-cao-notifications', [StaffController::class, 'CAONotifications'])->name('api.getCAONotifications');
Route::get('get-task-notifications', [StaffController::class, 'taskNotifications'])->name('api.getTaskNotifications');
Route::get('mark-as-read', [StaffController::class, 'markAsRead'])->name('api.markAsRead');
Route::get('get-users-accordingly', [TaskController::class, 'getUsers'])->name('api.getUsersAccordingly');
Route::get('submit-saman-name', [FormController::class, 'submit_saman_name'])->name('api.submit-saman-name');
Route::get('get-saman-name', [FormController::class, 'get_saman_name'])->name('api.get-saman-name');
Route::get('get-saman-detail', [FormController::class, 'get_saman_detail'])->name('api.get-saman-detail');

Route::get('budget-source-amount', [ApiHelperController::class, 'getBudgetSourceAmount'])->name('api.getBudgetSourceAmount');
Route::get('get-topic-area-type-id', [ApiHelperController::class, 'getTopicAreaType'])->name('api.getTopicAreaType');
Route::get('get-bank-name', [ApiHelperController::class, 'getBankName'])->name('api.getBankName');
Route::get('get-tole-bikas-samiti-detail', [ApiHelperController::class, 'getToleBikasSamitiDetail'])->name('api.getToleBikasSamitiDetail');
Route::get('get-anugaman-samiti', [ApiHelperController::class, 'getAnugmanSamiti'])->name('api.getAnugmanSamiti');
Route::get('get-anugaman-samiti-by-id', [ApiHelperController::class, 'getAnugmanSamitiById'])->name('api.getAnugmanSamitiById');
Route::get('get-post-by-staff-id', [ApiHelperController::class, 'getPostByStaffId'])->name('api.getPostByStaffId');
Route::get('get-child-role', [ApiHelperController::class, 'getChildRole'])->name('api.getChildRole');
