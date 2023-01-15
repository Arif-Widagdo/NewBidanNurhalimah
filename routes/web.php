<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GraduatedManagementController;
use App\Http\Controllers\Admin\PositionManagementController;
use App\Http\Controllers\Admin\StaffManagementController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\WorkManagementController;
use App\Http\Controllers\Crew\AcceptorManagementController;
use App\Http\Controllers\Crew\BCManagementController;
use App\Http\Controllers\Crew\CoupleManagementController;
use App\Http\Controllers\Crew\PatientManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (!App::isLocale('id') && !App::isLocale('en')) {
    App::setLocale('en');
}
Route::get('/locale/{locales}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [RouterController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [RouterController::class, 'profile'])->name('profile.edit');
    Route::post('/profile/picture-update', [ProfileController::class, 'updatePicture'])->name('profile.pictureUpdate');
    Route::patch('/profile/delete-picture', [ProfileController::class, 'deletePicture'])->name('profile.deletePicture');
    Route::patch('/profile-staf', [ProfileController::class, 'updateStaff'])->name('profile.update.staff');

    // ------------------
    // --- Auth Admin ---
    // ------------------
    Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::patch('/management-roles/{role:id}', [AdminController::class, 'roleUpdate'])->name('admin.role.update');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');

        // ----- Users Management
        Route::resource('/users', UserManagementController::class)->except(['create', 'edit']);
        // Route::delete('/users-management-deleteAll', [UserManagementController::class, 'deleteAll'])->name('admin.users.deleteAll');

        // ----- Position Management
        Route::get('/check-positions/slug', [PositionManagementController::class, 'checkSlug'])->name('admin.check.position');
        Route::resource('/positions', PositionManagementController::class)->except(['create', 'edit']);

        // ----- Graduated Management
        Route::get('/check-graduateds/slug', [GraduatedManagementController::class, 'checkSlug'])->name('admin.check.graduated');
        Route::resource('/graduateds', GraduatedManagementController::class)->except(['create', 'edit']);
        Route::delete('/graduateds-management-deleteAll', [GraduatedManagementController::class, 'deleteAll'])->name('admin.graduated.deleteAll');

        // Management Job
        Route::get('/check-works/slug', [WorkManagementController::class, 'checkSlug'])->name('admin.check.work');
        Route::resource('/works', WorkManagementController::class)->except(['create', 'edit']);
        Route::delete('/works-management-deleteAll', [WorkManagementController::class, 'deleteAll'])->name('admin.work.deleteAll');

        // Management Staff
        Route::resource('/staffs', StaffManagementController::class)->except(['show', 'edit']);
        Route::delete('/staffs-management-deleteAll', [StaffManagementController::class, 'deleteAll'])->name('admin.staff.deleteAll');
    });



    // ------------------
    // --- Auth Staff ---
    // ------------------
    Route::group(['prefix' => 'staff', 'middleware' => 'isStaff'], function () {
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('staff.profile.edit');
    });

    // ------------------
    // -- Auth Patient --
    // ------------------
    Route::group(['prefix' => 'patient', 'middleware' => 'isPatient'], function () {
        Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('patient.profile.edit');
    });

    // -------------------------
    // -- Auth ADMIN || STAFF --
    // -------------------------
    Route::group(['middleware' => ['isCrew']], function () {
        // Management Birth Control
        Route::get('/birth-controls/slug', [BCManagementController::class, 'checkSlug'])->name('check.birth.control');
        Route::resource('/birth-controls', BCManagementController::class)->except(['create', 'edit', 'show']);
        Route::delete('/birth-controls-deleteAll', [BCManagementController::class, 'deleteAll'])->name('birth-controls.deleteAll');

        // Management Patient
        Route::resource('/patients', PatientManagementController::class)->except(['show', 'edit']);
        Route::delete('/patients-management-deleteAll', [PatientManagementController::class, 'deleteAll'])->name('patient.deleteAll');
        // Management Acceptor
        Route::get('patient/{no_rm}/acceptors', [AcceptorManagementController::class, 'index'])->name('acceptors.index');
        Route::resource('/acceptors', AcceptorManagementController::class)->except(['index', 'create', 'show', 'edit']);
        Route::delete('/acceptors-management-deleteAll', [AcceptorManagementController::class, 'deleteAll'])->name('acceptor.deleteAll');
        // Management Couple
        Route::resource('/couples', CoupleManagementController::class)->except(['index', 'create', 'show', 'edit', 'destroy']);
    });
});



Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
