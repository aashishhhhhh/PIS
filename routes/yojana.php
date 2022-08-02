<?php

use App\Http\Controllers\YojanaControllers\ConsumerController;
use App\Http\Controllers\YojanaControllers\KulLagatController;
use App\Http\Controllers\YojanaControllers\OtherBibaranController;
use App\Http\Controllers\YojanaControllers\PlanController;
use App\Http\Controllers\YojanaControllers\SamitiGathanController;
use App\Http\Controllers\YojanaControllers\setting\AmanatController;
use App\Http\Controllers\YojanaControllers\setting\AnugamanSamitiController;
use App\Http\Controllers\YojanaControllers\setting\ContingencyController;
use App\Http\Controllers\YojanaControllers\setting\InstiutionalCommitteeController;
use App\Http\Controllers\YojanaControllers\ToleBikasSamitiController;
use App\Http\Controllers\YojanaControllers\TypeController;
use Illuminate\Support\Facades\Route;

// YOJANA
Route::get('/plan', [App\Http\Controllers\YojanaControllers\HomeController::class, 'index'])->name('yojana');
Route::prefix('yojana')->group(function () {
    // budget source
    Route::get('/budget-sources', [App\Http\Controllers\YojanaControllers\BudgetSourceController::class, 'index'])->name('budget-sources');
    Route::get('/new-plan', [PlanController::class, 'create'])->name('new-plan');
    Route::get('/plan', [PlanController::class, 'index'])->name('plan.index');
    Route::get('/break-down/{plan}', [PlanController::class, 'breakDown'])->name('plan.break');
    Route::post('/break-down/{plan}', [PlanController::class, 'storeBreakYojana'])->name('plan.breakdown');
    Route::post('/plan', [PlanController::class, 'store'])->name('plan.store');
    Route::post('/budget-sources/addOrUpdate', [App\Http\Controllers\YojanaControllers\BudgetSourceController::class, 'store'])->name('budget-sources.store');
    Route::post('/budget-source-amount/add', [App\Http\Controllers\YojanaControllers\BudgetSourceController::class, 'store_amount'])->name('budget-source-amount.store');
    // tole bikas samiti
    Route::get('/tole-bikas-samiti/print/{tole_bikas_samiti}', [ToleBikasSamitiController::class,'print'])->name('tole-bikas-samiti.print');
    Route::get('/tole-bikas-samiti/bank-print/{tole_bikas_samiti}', [ToleBikasSamitiController::class,'printBank'])->name('tole-bikas-samiti.print_bank');
    Route::get('/tole-bikas-samiti/bank/{tole_bikas_samiti}', [ToleBikasSamitiController::class,'bank'])->name('tole-bikas-samiti.bank');
    Route::get('/tole-bikas-samiti/print-praman-patra/{tole_bikas_samiti}', [ToleBikasSamitiController::class,'printPramanPatra'])->name('tole-bikas-samiti.praman');
    Route::resource('/tole-bikas-samiti', ToleBikasSamitiController::class)->except('destroy');
    //Anugaman samiti
    Route::get('/anugaman-samiti/set-staus/{anugaman_samiti_detail}', [AnugamanSamitiController::class,'setStatus'])->name('anugaman.setStatus');
    Route::resource('/anugaman-samiti', AnugamanSamitiController::class)->except('destroy');

    // plan operate
    Route::get('/samiti-gathan', [SamitiGathanController::class,'index'])->name('samiti-gathan.index');
    Route::get('/plan-operate', [SamitiGathanController::class,'planOperateDashboard'])->name('plan-operate.index');
    Route::get('/plan-operate/{slug}', [SamitiGathanController::class,'searchPlan'])->name('plan-operate.search');
    Route::post('/plan-operate', [SamitiGathanController::class,'searchPlanByRegno'])->name('plan-operate.searchSubmit');
    Route::resource('/contingency', ContingencyController::class);

    Route::group(['middleware' => 'type'], function () {
        // kul lagat route
        Route::get('/plan/kul-lagat/{reg_no}', [KulLagatController::class,'index'])->name('plan.kul-lagat');
        Route::post('/kul-lagat', [KulLagatController::class,'store'])->name('kul_lagat.store');
        Route::put('/kul-lagat/update', [KulLagatController::class,'update'])->name('kul_lagat.update');
        // type bibran route
        Route::get('/plan/type-bibaran/{reg_no}', [TypeController::class,'index'])->name('plan.consumer-bibaran');
        Route::post('/plan/type-bibaran/store', [TypeController::class,'store'])->name('type.store');
        Route::put('/plan/type-bibaran/update/{type}', [TypeController::class,'update'])->name('type.update');
        // consumer bibaran
        Route::get('/plan/consumer-bibaran/{reg_no}', [ConsumerController::class,'index'])->name('plan_consumer.index');
        Route::post('/plan/consumer-bibaran/store', [ConsumerController::class,'store'])->name('plan_consumer.store');
        Route::put('/plan/consumer-bibaran/update/{consumer}', [ConsumerController::class,'update'])->name('plan_consumer.update');
        // Sanstha samiti
        Route::get('/plan/sanstha_samiti/{reg_no}', [InstiutionalCommitteeController::class,'index'])->name('plan_sanstha.index');
        Route::post('/plan/sanstha_samiti', [InstiutionalCommitteeController::class,'store'])->name('plan_sanstha_samiti.store');
        Route::put('/plan/sanstha_samiti/{institutional_committee}', [InstiutionalCommitteeController::class,'update'])->name('plan_sanstha_samiti.update');
        // amanat marfat
        Route::get('/plan/amanat-marfat/{reg_no}', [AmanatController::class,'index'])->name('plan_amanat_marfat.index');
        Route::post('/plan/amanat-marfat', [AmanatController::class,'store'])->name('plan_amanat_marfat.store');
        Route::put('/plan/amanat-marfat/{amanat}', [AmanatController::class,'update'])->name('plan_amanat_marfat.update');
        //anugmana samiti bibran
        Route::get('/plan/anugaman-samiti/{reg_no}', [AnugamanSamitiController::class,'showAnugmanBibaran'])->name('plan.anugaman');
        Route::post('/plan/anugaman-samiti', [AnugamanSamitiController::class,'storeAnugmanBibaran'])->name('plan.anugaman_store');
        Route::put('/plan/anugaman-samiti/{anugaman_samiti}', [AnugamanSamitiController::class,'updateAnugmanBibaran'])->name('plan.anugaman_update');
        //yojana anya bibran
        Route::get('/plan/other-bibaran/{reg_no}', [OtherBibaranController::class,'index'])->name('plan.other_bibaran');
        Route::post('/plan/other-bibaran', [OtherBibaranController::class,'store'])->name('other-bibaran.store');
        Route::put('/plan/other-bibaran/{other_bibaran}', [OtherBibaranController::class,'update'])->name('other-bibaran.update');
    });

});
