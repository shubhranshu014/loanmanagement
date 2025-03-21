<?php

use App\Http\Controllers\Accountant\LoanproductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\Loanofficer\LoanController;
use App\Http\Controllers\Loanofficer\LoanofficerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get("/admin/dashboard",[AdminController::class,"dashboard"])->name("admin.dashboard");
    Route::get("/admin/branch/add",[AdminController::class,"addbranch"])->name("admin.add.branch");
    Route::post("/admin/branch/store",[AdminController::class,"storebranch"])->name("admin.store.branch");
    Route::put('/admin/branch/update/{id}', [AdminController::class, 'bupdate'])->name('admin.update.branch');
    Route::delete('/admin/branch/delete/{id}', [AdminController::class, 'bdestroy'])->name('admin.destroy.branch');

    Route::get("/admin/loanofficer/add",[AdminController::class,"addloanofficer"])->name("admin.add.loanofficer");
    Route::post("/admin/loanofficer/store",[AdminController::class,"storeloanofficer"])->name("admin.store.loanofficer");
    Route::put('/admin/loanofficer/update/{id}', [AdminController::class, 'oupdate'])->name('admin.update.loanofficer');
    Route::delete('/admin/loanofficer/delete/{id}', [AdminController::class, 'odestroy'])->name('admin.delete.loanofficer');


    Route::get("/admin/loan-product",[LoanproductController::class,"loanproduct"])->name("admin.details.loanproduct");
    Route::get("/admin/add/loan-product",[LoanproductController::class,"addloanproduct"])->name("admin.add.loanproduct");
    Route::post("/admin/store/loan-product",[LoanproductController::class,"storeloanproduct"])->name("admin.store.loanproduct");

    Route::get("/admin/loan/details",[AdminController::class,"loandetails"])->name("admin.loan.details");
    Route::put('/loan/change-status/{id}', [AdminController::class, 'changeStatus'])->name('admin.loan.changeStatus');

    Route::get('/admin/loan-calculator', [CalculatorController::class, 'calculaterview'])->name('admin.loan.calculatorview');
    Route::post('/admin/loan-calculate', [CalculatorController::class, 'calculate'])->name('admin.calculate.loan');

});

Route::middleware(['auth', 'role:loanofficer'])->group(function () {
    Route::get("/loanofficer/dashboard",[LoanofficerController::class,"dashboard"])->name("loanofficer.dashboard");

    Route::get("/loanofficer/details/members",[LoanofficerController::class,"members"])->name("loanofficer.details.members");
    Route::post("/loanofficer/store/members",[LoanofficerController::class,"storemembers"])->name("loanofficer.store.members");

    Route::get("/loanofficer/loan/details",[LoanofficerController::class,"loandetails"])->name("loanofficer.loan.details");
    Route::get("/loanofficer/loan/add",[LoanController::class,"loanadd"])->name("loanofficer.loan.add");
    Route::post("/loanofficer/loan/store",[LoanController::class,"loanstore"])->name("loanofficer.loan.store");

    Route::get('/api/get-loan-product/{id}', [LoanController::class, 'getLoanProduct']);

    Route::get('/loanofficer/loan-calculator', [LoanController::class, 'calculaterview'])->name('loanofficer.loan.calculatorview');
    Route::post('/loanofficer/loan-calculate', [LoanController::class, 'calculate'])->name('loanofficer.calculate.loan');
    Route::get("/loanofficer/loan-product",[LoanofficerController::class,"loanproduct"])->name("loanofficer.details.loanproduct");
});


