<?php

use App\Http\Controllers\PisControllers\FormController;
use App\Http\Controllers\PisControllers\StaffController;
use App\Http\Controllers\PisControllers\TaskController;
use App\Http\Controllers\PisControllers\ViewController;
use App\Http\Middleware\CheckApproved;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

Route::post('register-user', [StaffController::class, 'register_user'])->name('register-user');
Route::prefix('staff')->group(function () {

    Route::get('testing', function () {
        return view('pis.staff.forms.test');
    })->name('testing');
    Route::middleware([CheckApproved::class])->group(function () {

        Route::get('/staff_form', [App\Http\Controllers\PisControllers\StaffController::class, 'staff_form'])->name('staff_form');
        Route::post("page1", [StaffController::class, "staff_form_page_1_save"])->name('page_1_submit');

        Route::get('page2', [StaffController::class, 'staff_form_page_2'])->name('page_2_show');
        Route::post("page2", [StaffController::class, "staff_form_page_2_save"])->name('page_2_submit');

        Route::get('page3', [StaffController::class, 'staff_form_page_3'])->name('page_3_show');
        Route::post("page3", [StaffController::class, "staff_form_page_3_save"])->name('page_3_submit');

        Route::get('page4', [StaffController::class, 'staff_form_page_4'])->name('page_4_show');
        Route::post('page4', [StaffController::class, "staff_form_page_4_save"])->name('page_4_submit');

        Route::get('page5', [StaffController::class, 'staff_form_page_5'])->name('page_5_show');
        Route::post('page5', [StaffController::class, "staff_form_page_5_save"])->name('page_5_submit');

        Route::get('page6', [StaffController::class, 'staff_form_page_6'])->name('page_6_show');
        Route::post('page6', [StaffController::class, 'staff_form_page_6_save'])->name('page_6_submit');

        Route::get('page7', [StaffController::class, 'staff_form_page_7'])->name('page_7_show');
        Route::post('page7', [StaffController::class, 'staff_form_page_7_save'])->name('page_7_submit');

        Route::get('page8', [StaffController::class, 'staff_form_page_8'])->name('page_8_show');
        Route::post('page8', [StaffController::class, 'staff_form_page_8_save'])->name('page_8_submit');

        Route::get('page9', [StaffController::class, 'staff_form_page_9'])->name('page_9_show');
        Route::post('page9', [StaffController::class, 'staff_form_page_9_save'])->name('page_9_submit');

        Route::get('page10', [StaffController::class, 'staff_form_page_10'])->name('page_10_show');
        Route::post('page10', [StaffController::class, 'staff_form_page_10_save'])->name('page_10_submit');

        Route::get('page11', [StaffController::class, 'staff_form_page_11'])->name('page_11_show');
        Route::post('page11', [StaffController::class, 'staff_form_page_11_save'])->name('page_11_submit');

        Route::get('page12', [StaffController::class, 'staff_form_page_12'])->name('page_12_show');
        Route::post('page12', [StaffController::class, 'staff_form_page_12_save'])->name('page_12_submit');

        Route::get('page13', [StaffController::class, 'staff_form_page_13'])->name('page_13_show');
        Route::post('page13', [StaffController::class, 'staff_form_page_13_save'])->name('page_13_submit');

        Route::get('page14', [StaffController::class, 'staff_form_page_14'])->name('page_14_show');
        Route::post('page14', [StaffController::class, 'staff_form_page_14_save'])->name('page_14_submit');
    });

    Route::get('my-sheetroll/{id}', [StaffController::class, 'sheetroll_show'])->name('my-sheetroll');



    Route::get('verify-all-form/{staff}', [StaffController::class, 'verify_all_form'])->name('verify-all-form');
    Route::get('disprove-all-form/{staff}', [StaffController::class, 'disprove_all_form'])->name('disprove-all-form');

    Route::get('approve-all-form/{staff}', [StaffController::class, 'approve_all_form'])->name('approve-all-form');
    Route::get('decline-all-form/{staff}', [StaffController::class, 'decline_all_form'])->name('decline-all-form');

    Route::get('staff-detail-list/{id}', [StaffController::class, 'staff_detail_list'])->name('staff-detail-list');

    Route::get('leave_setting', [StaffController::class, 'leave_setting_form'])->name('leave-setting');
    Route::post('add_leave_setting', [StaffController::class, 'leave_setting_submit'])->name('add-leave-setting');
    Route::post('edit_leave_setting', [StaffController::class, 'edit_leave_setting'])->name('edit-leave-setting');
    Route::get('leave_application', [StaffController::class, 'leave_application_form'])->name('leave-application');
    Route::post('leave_application', [StaffController::class, 'leave_application_form_submit'])->name('leave-application-submit');

    Route::post('add-setting-prev-leave', [StaffController::class, 'add_setting_prev_leave'])->name('add-setting-prev-leave');

    Route::get('leave-approval', [StaffController::class, 'leave_approval'])->name('leave-approval');
    Route::get('leave-approved/{id}', [StaffController::class, 'leave_approved'])->name('leave-approved');
    Route::get('cao-leave-approved/{id}', [StaffController::class, 'cao_leave_approved'])->name('cao-leave-approved');
    Route::get('leave-approved-detailss/{id}', [StaffController::class, 'leave_approval_detail'])->name('leave-approved-detail');
    Route::get('edit-leave-application/{leaveApplication}', [StaffController::class, 'edit_leave_application'])->name('edit-leave-application');
    Route::post('update-leave-application', [StaffController::class, 'update_leave_application'])->name('update-leave-application');



    // edit-leave-application-submit

    // Route::get('leaveDatas/{id}',[StaffController::class,'leaveDataTest'])->name('get-total-leave');

    Route::get('leave_and_medicine', [StaffController::class, 'leave_and_medicine_payment'])->name('leave-and-medicine-details');

    //Staff Search
    Route::get('staff-search', [StaffController::class, 'staff_search'])->name('staff-search')->middleware(['middleware' => 'role:admin|cao']);
    Route::get('staff-search-submit', [StaffController::class, 'staff_search_submit'])->name('search-staff-submit')->middleware(['middleware' => 'role:admin|cao']);

    //Staff sheetroll
    Route::get('sheetroll-show/{id}', [StaffController::class, 'sheetroll_show'])->name('sheetroll-show');

    //Staff registration request list
    Route::get('staff_reg_request_list', [StaffController::class, 'staff_reg_request_list'])->name('staff-reg-request-list');
    Route::get('verify-reg-request/{user}', [StaffController::class, 'verify_request'])->name('verify-reg-request');
    Route::get('reject-reg-request/{user}', [StaffController::class, 'reject_request'])->name('reject-reg-request');
    Route::get('delete-reg-request/{user}', [StaffController::class, 'delete_request'])->name('delete-reg-request');

    Route::get('registered-staffs', [StaffController::class, 'registered_staffs'])->name('registered-staffs');
    Route::get('decline-registered-staffs', [StaffController::class, 'decline_registered_staffs'])->name('decline-registered-staffs');

    Route::get('all-notification', [StaffController::class, 'all_notification'])->name('all-notification');
    Route::get('mark-as-read/{notification}', [StaffController::class, 'mark_as_read'])->name('mark-as-read');






    //------Maag Forms and Others---------------------------//

    Route::get('maag-form', [FormController::class, 'maag_form_show'])->name('buy-maag-form');
    Route::post('maag-form-submit', [FormController::class, 'maag_form_submit'])->name('maag_form_submit');
    Route::get('maag-form-print', [FormController::class, 'maag_form_print'])->name('maag-form-print');
    Route::get('maag-form-list', [FormController::class, 'maag_form_list'])->name('maag-form-list');
    Route::get('view-maag-details/{maag}', [FormController::class, 'view_maag_details'])->name('view-maag-details');
    Route::get('verify-maag-details/{maag}', [FormController::class, 'verify_maag_details'])->name('verify-maag-details');
    Route::get('decline-maag-details/{maag}', [FormController::class, 'decline_maag_details'])->name('decline-maag-details');
    Route::get('approve-maag-details/{maag}', [FormController::class, 'approve_maag_details'])->name('approve-maag-details');
    Route::get('disapprove-maag-details/{maag}', [FormController::class, 'disapprove_maag_details'])->name('disapprove-maag-details');
    Route::get('fill-maag-details/{maag}', [FormController::class, 'fill_maag_details'])->name('fill-maag-details');
    Route::get('edit-maag-form/{maag}', [FormController::class, 'edit_maag_form'])->name('edit-maag-form');
    Route::post('update-maag-form', [FormController::class, 'update_maag_form'])->name('update-maag-form');
    // disapprove_maag_details


    Route::get('marmat-aadesh-form', [FormController::class, 'marmat_aadesh_form'])->name('marmat-aadesh-form');
    Route::post('marmat-aadesh-form-submit', [FormController::class, 'marmat_aadesh_form_submit'])->name('marmat-aadesh-form-submit');
    Route::get('marmat-form-print', [FormController::class, 'print_marmat_form'])->name('marmat-form-print');
    Route::get('marmat-form-list', [FormController::class, 'marmat_form_list'])->name('marmat-form-list');
    Route::get('view-marmat-details/{marmat}', [FormController::class, 'view_marmat_details'])->name('view-marmat-details');
    Route::get('verify-marmat-details/{marmat}', [FormController::class, 'verify_marmat_details'])->name('verify-marmat-details');
    Route::get('decline-marmat-details/{marmat}', [FormController::class, 'decline_marmat_details'])->name('decline-marmat-details');
    Route::get('approve-marmat-details/{marmat}', [FormController::class, 'approve_marmat_details'])->name('approve-marmat-details');
    Route::get(' disapprove-marmat-details/{marmat}', [FormController::class, 'disapprove_marmat_details'])->name('disapprove-marmat-details');
    Route::get('fill-marmat-details/{marmatno}', [FormController::class, 'fill_marmat_details'])->name('fill-marmat-details');
    Route::get('marmat-storekeeper-form/{marmatno}', [FormController::class, 'marmat_storekeeper_form'])->name('marmat-storekeeper-form');
    Route::post('marmat-storekeeper-form-submit', [FormController::class, 'marmat_storekeeper_form_submit'])->name('marmat-storekeeper-form-submit');
    Route::get('edit-marmat-form/{marmatno}', [FormController::class, 'edit_marmat_form'])->name('edit-marmat-form');
    Route::post('update-marmat-form', [FormController::class, 'update_marmat_form'])->name('update-marmat-form');

    Route::get('bhraman-pratiwedan-form/{visit}', [FormController::class, 'bhraman_pratiwedan_form'])->name('bhraman-pratiwedan-form');
    Route::post('bhraman-pratiwedan-form_submit', [FormController::class, 'bhraman_pratiwedan_form_submit'])->name('bhraman_pratiwedan_form_submit');
    Route::get('bhraman-pratiwedan-list', [FormController::class, 'bhraman_pratiwedan_list'])->name('bhraman-pratiwedan-list');
    Route::get('view-bhraman-details/{bhraman}', [FormController::class, 'view_bhraman_details'])->name('view-bhraman-details');
    Route::get('bhraman-list', [FormController::class, 'bhraman_list'])->name('bhraman-list');
    Route::get('approve-bhraman/{visit}', [FormController::class, 'approve_bhraman'])->name('approve-bhraman');
    Route::get('reject-bhraman/{visit}', [FormController::class, 'reject_bhraman'])->name('reject-bhraman');
    Route::get('approve-particular-destination/{destination}', [FormController::class, 'approve_destination'])->name('approve-particular-destination');
    Route::get('decline-particular-destination/{destination}', [FormController::class, 'decline_destination'])->name('decline-particular-destination');
    Route::post('print-bhraman-kharcha', [FormController::class, 'print_bhraman_kharcha'])->name('print-bhraman-kharcha');

    // Route::post('bhraman-aadesh-no-search', [FormController::class, 'bhraman_aadesh_no_search'])->name('bhraman-aadesh-no-search');
    // Route::post('bhraman-kharcha-form_submit', [FormController::class, 'bhraman_kharcha_form_submit'])->name('bhraman-kharcha-form-submit');

    Route::get('bhraman-kharcha-form/{visit}', [FormController::class, 'bhraman_kharcha_form'])->name('bhraman-kharcha-form');
    Route::post('bhraman-kharcha-form-print', [FormController::class, 'bhraman_kharcha_form_print'])->name('bhraman-kharcha-form-print');


    Route::get('bhraman-aadesh-form', [FormController::class, 'bhraman_aadesh_form'])->name('bhraman-aadesh-form');
    Route::post('bhraman-addesh-submit', [FormController::class, 'bhraman_addesh_submit'])->name('bhraman-addesh-submit');
    Route::get('bhraman_addesh_edit/{visit}', [FormController::class, 'bhraman_addesh_edit'])->name('bhraman-aadesh-edit');

    Route::post('bhraman-addesh-update', [FormController::class, 'bhraman_addesh_update'])->name('bhraman-addesh-update');

    //--Settings-----------------------------------------//
    Route::get('pis-setting/{setting}', [FormController::class, 'pis_setting'])->name('pis-setting');
    Route::post('add-setting', [FormController::class, 'pis_setting_add'])->name('add-setting');
    Route::post('update-setting', [FormController::class, 'pis_setting_update'])->name('update-setting');

    Route::get('setting-bhatta', [FormController::class, 'setting_bhatta'])->name('setting-bhatta');
    Route::post('add-setting-bhatta', [FormController::class, 'add_setting_bhatta'])->name('add-bhatta-setting');
    Route::post('edit-bhatta-setting', [FormController::class, 'edit_bhatta_setting'])->name('edit-bhatta-setting');



    Route::group(['middleware' => ['role:admin|cao']], function () {
        //------------Admin View-------------------------------/////////
        Route::get('view-form1/{user}', [ViewController::class, 'view_form1'])->name('view-form1');
        Route::get('edit-form1/{user}', [ViewController::class, 'edit_form1'])->name('edit-form1');

        Route::get('view-form2/{user}', [ViewController::class, 'view_form2'])->name('view-form2');
        Route::get('edit-form2/{user}', [ViewController::class, 'edit_form2'])->name('edit-form2');

        Route::get('view-form3/{user}', [ViewController::class, 'view_form3'])->name('view-form3');
        Route::get('edit-form3/{user}', [ViewController::class, 'edit_form3'])->name('edit-form3');

        Route::get('view-form4/{user}', [ViewController::class, 'view_form4'])->name('view-form4');
        Route::get('edit-form4/{user}', [ViewController::class, 'edit_form4'])->name('edit-form4');

        Route::get('view-form5/{user}', [ViewController::class, 'view_form5'])->name('view-form5');
        Route::get('edit-form5/{user}', [ViewController::class, 'edit_form5'])->name('edit-form5');

        Route::get('view-form5/{user}', [ViewController::class, 'view_form5'])->name('view-form5');
        Route::get('edit-form5/{user}', [ViewController::class, 'edit_form5'])->name('edit-form5');

        Route::get('view-form6/{user}', [ViewController::class, 'view_form6'])->name('view-form6');
        Route::get('edit-form6/{user}', [ViewController::class, 'edit_form6'])->name('edit-form6');

        Route::get('view-form7/{user}', [ViewController::class, 'view_form7'])->name('view-form7');
        Route::get('edit-form7/{user}', [ViewController::class, 'edit_form7'])->name('edit-form7');

        Route::get('view-form8/{user}', [ViewController::class, 'view_form8'])->name('view_form8');
        Route::get('edit-form8/{user}', [ViewController::class, 'edit_form8'])->name('edit-form8');

        Route::get('view-form9/{user}', [ViewController::class, 'view_form9'])->name('view_form9');
        Route::get('edit-form9/{user}', [ViewController::class, 'edit_form9'])->name('edit-form9');

        Route::get('view-form10/{user}', [ViewController::class, 'view_form10'])->name('view_form10');
        Route::get('edit-form10/{user}', [ViewController::class, 'edit_form10'])->name('edit-form10');

        Route::get('view-form11/{user}', [ViewController::class, 'view_form11'])->name('view_form11');
        Route::get('edit-form11/{user}', [ViewController::class, 'edit_form11'])->name('edit-form11');

        Route::get('view-form12/{user}', [ViewController::class, 'view_form12'])->name('view_form12');
        Route::get('edit-form12/{user}', [ViewController::class, 'edit_form12'])->name('edit-form12');

        Route::get('view-form13/{user}', [ViewController::class, 'view_form13'])->name('view_form13');
        Route::get('edit-form13/{user}', [ViewController::class, 'edit_form13'])->name('edit-form13');

        Route::get('view-form14/{user}', [ViewController::class, 'view_form14'])->name('view_form14');
        Route::get('edit-form14/{user}', [ViewController::class, 'edit_form14'])->name('edit-form14');

        Route::get('task-add', [TaskController::class, 'task_add'])->name('task-add');
        Route::post('task-store', [TaskController::class, 'task_store'])->name('task-store');
        Route::post('assign-task', [TaskController::class, 'assign_task'])->name('assign-task');
    });


    Route::get('assigned-task-list/{tasks}', [TaskController::class, 'assigned_task_list'])->name('assigned-task-list');
    Route::get('task-list', [TaskController::class, 'task_list'])->name('task-list');
    Route::get('assigned-task-comment/{tasks}', [TaskController::class, 'assigned_task_comment'])->name('assigned-task-comments');
    Route::post('assigned-task-comments', [TaskController::class, 'assigned_task_comment_submit'])->name('assigned-task-comment');
    Route::post('submit-task-status', [TaskController::class, 'submit_task_status'])->name('submit-task-status');
    Route::get('view-task-description/{task}', [TaskController::class, 'view_task_description'])->name('view-task-description');
    Route::get('test', [TaskController::class, 'test'])->name('test.test');




    Route::get('view', function () {
        return view('pis.staff.forms.print_bhraman_kharcha_bill');
    });
});



// 
