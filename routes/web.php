<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BatchScheduleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\DashboardDetailsController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyClassController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PreliminarySelectionController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TraineeEnrollmentController;
use App\Http\Controllers\TrainerEnrollmentController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TmsInspectionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    /**
     * language change route
     */
    Route::get('/lang/change', [HomeController::class, 'change'])->name('changeLang');
    /**
     * Register Routes
     */
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');

    /**
     * Login Routes
     */
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');

    /**
     * user dashboard Routes
     */
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    /**
     * user dashboard Routes
     */
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');

    Route::post('/store-auth-user', [AuthUserController::class, 'storeAuthUser'])->name('storeAuth');
    Route::get('/auth-error', [AuthUserController::class, 'authError'])->name('auth.error');

    Route::group(['middleware' => ['permission']], function () {
        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/{userId}', [UserController::class, 'show'])->name('users.show');
        });

        /**
         * Preliminary selected User Routes
         */
        Route::group(['prefix' => 'preliminary-selected'], function () {
            Route::get('/', [PreliminarySelectionController::class, 'index'])->name('preliminary-selected.index');
            Route::get('/{userId}', [PreliminarySelectionController::class, 'show'])->name('preliminary-selected.show');
        });

        /**
         * User Routes
         */
        Route::group(['prefix' => 'admins'], function () {
            Route::get('/', [AdminController::class, 'index'])->name('admins.index');
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admins.dashboard');
            Route::get('/profile', [AdminController::class, 'profile'])->name('admins.profile');
            Route::get('/{userProfileId}/show', [AdminController::class, 'show'])->name('admins.show');
        });

        /**
         * Categories Routes
         */
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/{categoryId}', [CategoryController::class, 'show'])->name('categories.show');
        });

        /**
         * Sub Categories Routes
         */
        Route::group(['prefix' => 'subcategories'], function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('subcategories.index');
            Route::get('/{subCategoryId}', [SubCategoryController::class, 'show'])->name('subcategories.show');
        });

        /**
         * Divisions Routes
         */
        Route::group(['prefix' => 'divisions'], function () {
            Route::get('/', [DivisionController::class, 'index'])->name('divisions.index');
            Route::get('/{divisionId}', [DivisionController::class, 'show'])->name('divisions.show');
        });

        /**
         * District Routes
         */
        Route::group(['prefix' => 'districts'], function () {
            Route::get('/', [DistrictController::class, 'index'])->name('districts.index');
            Route::get('/{districtId}', [DistrictController::class, 'show'])->name('districts.show');
        });

        /**
         * Upazila Routes
         */
        Route::group(['prefix' => 'upazilas'], function () {
            Route::get('/', [UpazilaController::class, 'index'])->name('upazilas.index');
            Route::get('/{upazilaId}', [UpazilaController::class, 'show'])->name('upazilas.show');
        });

        /**
         * Providers Routes
         */
        Route::group(['prefix' => 'providers'], function () {
            Route::get('/', [ProviderController::class, 'index'])->name('providers.index');
            Route::get('/{providerId}', [ProviderController::class, 'show'])->name('providers.show');
        });

        /**
         * Committee Routes
         */
        Route::group(['prefix' => 'committees'], function () {
            Route::get('/', [CommitteeController::class, 'index'])->name('committees.index');
            Route::get('/{committeeId}', [CommitteeController::class, 'show'])->name('committees.show');
        });

        /**
         * Batches Routes
         */
        Route::group(['prefix' => 'batches'], function () {
            Route::get('/', [BatchController::class, 'index'])->name('batches.index');
            Route::get('/all', [BatchController::class, 'all'])->name('batches.all');
            Route::get('/{batchId}', [BatchController::class, 'show'])->name('batches.show');
        });

        /**
         * Trainees Enrollment Routes
         */
        Route::group(['prefix' => 'trainee-enrollment'], function () {
            Route::get('/', [TraineeEnrollmentController::class, 'index'])->name('traineeEnroll.index');
            Route::get('/{enrollId}', [TraineeEnrollmentController::class, 'show'])->name('traineeEnroll.show');
        });

        /**
         * Trainers Enrollment Routes
         */
        Route::group(['prefix' => 'trainer-enrollment'], function () {
            Route::get('/', [TrainerEnrollmentController::class, 'index'])->name('trainerEnroll.index');
            Route::get('/{enrollId}', [TrainerEnrollmentController::class, 'show'])->name('trainerEnroll.show');
        });

        /**
         * User Permission
         */
        Route::group(['prefix' => 'permission'], function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
        });

        /**
         * Role Routes
         */
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.index');
            Route::get('/{roleId}', [RoleController::class, 'show'])->name('role.show');
            Route::get('/{roleId}', [RoleController::class, 'edit'])->name('role.edit');
        });

        /**
         * Class Routes
         */
        Route::group(['prefix' => 'my-class'], function () {
            Route::get('/{scheduleId}', [MyClassController::class, 'index'])->name('my-class.index');
            Route::get('/{scheduleId}/attendance', [MyClassController::class, 'checkAttendance'])->name('my-class.attendance');
        });

        /**
         * Attendance Routes
         */
        Route::group(['prefix' => 'attendance'], function () {
            Route::get('/batch-list', [BatchScheduleController::class, 'trainerBatch'])->name('attendance.batch-list');
            Route::get('/{scheduleId}/show', [AttendanceController::class, 'show'])->name('attendance.show');
            Route::get('/{scheduleDetailId}/show/schedule', [AttendanceController::class, 'showAttendance'])->name('attendance.schedule');
            Route::get('/{scheduleDetailId}/start', [AttendanceController::class, 'start'])->name('attendance.start');
            Route::get('/{scheduleDetailId}/student-list/', [AttendanceController::class, 'attendanceForm'])->name('attendance.form');
            Route::post('/{scheduleDetailId}/take-attendance', [AttendanceController::class, 'takeAttendance'])->name('attendance.take-attendance');
            Route::get('/{scheduleDetailId}/end', [AttendanceController::class, 'end'])->name('attendance.end');
        });

        /**
         * Batch Schedule Routes
         */
        Route::group(['prefix' => 'batch_schedules'], function () {
            Route::get('/', [BatchScheduleController::class, 'batches'])->name('batch-schedule.batches');
            Route::get('/all/{schedule_id}/{batch_id}', [BatchScheduleController::class, 'index'])->name('batch-schedule.index');
            Route::get('/create/{batch_id}', [BatchScheduleController::class, 'create'])->name('batch-schedule.create');
            Route::post('/store', [BatchScheduleController::class, 'store'])->name('batch-schedule.store');
            Route::get('/show/{schedule_id}/{batch_id}', [BatchScheduleController::class, 'show'])->name('batch-schedule.office');
        });

        //Route::resource('tms-inspections', TmsInspectionController::class);
        Route::get('/tms-inspections', [TmsInspectionController::class, 'index'])->name('inspaction.index');
        Route::get('/tms-inspections/show/{id}', [TmsInspectionController::class, 'show'])->name('tms-inspections.show');
        Route::get('/tms-inspections/create', [TmsInspectionController::class, 'create'])->name('tms-inspections.create');
        Route::post('/inspections/store', [TmsInspectionController::class, 'store'])->name('tms-inspections.store');
        // Route::delete('/tms-inspections/edit', [TmsInspectionController::class, 'index'])->name('tms-inspections.edit');
        // Route::res
        /**
         * Dashboard Details Route
         */
        Route::group(['prefix' => 'dashboard_details'], function () {
            Route::get('/total_batches', [DashboardDetailsController::class, 'totalBatches'])->name('dashboard_details.total_batches');
            Route::get('/running_batches', [DashboardDetailsController::class, 'runningBatches'])->name('dashboard_details.running_batches');
            Route::get('/complete_batches', [DashboardDetailsController::class, 'completeBatches'])->name('dashboard_details.complete_batches');
            Route::get('/districts', [DashboardDetailsController::class, 'districts'])->name('dashboard_details.districts');
            Route::get('/upazilas', [DashboardDetailsController::class, 'upazilas'])->name('dashboard_details.upazilas');
            Route::get('/partners', [DashboardDetailsController::class, 'partners'])->name('dashboard_details.partners');
            Route::get('/trainers', [DashboardDetailsController::class, 'trainers'])->name('dashboard_details.trainers');
            Route::get('/trainees', [DashboardDetailsController::class, 'trainees'])->name('dashboard_details.trainees');

        });
    });
});