<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FSDKUser\LandingController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\FSDKUser\AuthFSDKUserController;
use App\Http\Controllers\technician\TechnicianController;
use App\Http\Controllers\FSDKUser\DashboardController;
use App\Http\Controllers\FSDKUser\ComplaintController;

Route::get('/', function () {
    return view('index');
});

Route::get('/faq', [LandingController::class, 'faq'])->name('faq');
Route::get('/report-issue', [LandingController::class, 'reportIssue'])->name('report.issue');

// FSDK User Authentication
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [AuthFSDKUserController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthFSDKUserController::class, 'login'])->name('login.process');
    Route::post('/logout', [AuthFSDKUserController::class, 'logout'])->name('logout');
});

// FSDK User
Route::middleware('fsdk.user')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints');
    Route::get('/complaints/{id}', [ComplaintController::class, 'detail'])->name('complaints.detail');
    Route::post('/complaints/{id}/feedback', [ComplaintController::class, 'storeFeedback'])->name('complaints.feedback.store');    

    Route::get('/report-issue', [ComplaintController::class, 'create'])->name('report-issue');
    Route::post('/report-issue', [ComplaintController::class, 'store'])->name('report-issue.store');

    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/faqlogin', [DashboardController::class, 'faq'])->name('faqlogin');
    
});


Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.process');
Route::get('/admin/register', [AuthController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register.process');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

//admin
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {        
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/complaints', [AdminController::class, 'complaints'])->name('complaints');    
    Route::get('/complaints/{id}', [AdminController::class, 'complaintDetail'])->name('complaints.detail');
    Route::post('/complaints/{id}/priority', [AdminController::class, 'updateComplaintPriority'])->name('complaints.priority.update');
    Route::post('/complaints/{id}/reject', [AdminController::class, 'rejectComplaint'])->name('complaints.reject');

    Route::get('/users', [AdminController::class, 'userManagement'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');

    Route::get('/assignments', [AdminController::class, 'assignments'])->name('assignments');
    Route::get('/assignments/create', [AdminController::class, 'createAssignment'])->name('assignments.create');
    Route::post('/assignments', [AdminController::class, 'storeAssignment'])->name('assignments.store');
    Route::get('/assignments/{id}', [AdminController::class, 'assignmentDetail'])->name('assignments.detail');

    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/reports/technician-performance/pdf', [AdminController::class, 'exportTechnicianPerformance'])
    ->name('reports.technician-performance.pdf');
    Route::get('/reports/maintenance/pdf', [AdminController::class, 'exportMaintenanceReport'])
    ->name('reports.maintenance.pdf');
    Route::get('/reports/rejected-complaints/pdf', [AdminController::class, 'exportRejectedComplaints'])
    ->name('reports.rejected-complaints.pdf');
    Route::get('/reports/user-feedback/pdf', [AdminController::class, 'exportUserFeedback'])
    ->name('reports.user-feedback.pdf');

    Route::get('/locations', [AdminController::class, 'locations'])->name('locations');        
    Route::get('/locations/create', [AdminController::class, 'createLocation'])->name('locations.create');
    Route::post('/locations', [AdminController::class, 'storeLocation'])->name('locations.store');
    Route::get('/locations/{id}/edit', [AdminController::class, 'editLocation'])->name('locations.edit');
    Route::put('/locations/{id}', [AdminController::class, 'updateLocation'])->name('locations.update');

    Route::get('/facility-types', [AdminController::class, 'facilityTypes'])->name('facility.types');        
    Route::get('/facility-types/create', [AdminController::class, 'createFacilityType'])->name('facility.types.create');
    Route::post('/facility-types', [AdminController::class, 'storeFacilityType'])->name('facility.types.store');
    Route::get('/facility-types/{id}/edit', [AdminController::class, 'editFacilityType'])->name('facility.types.edit');
    Route::post('/facility-types/{id}', [AdminController::class, 'updateFacilityType'])->name('facility.types.update');

    Route::get('/settings', [AdminController::class, 'accountSettings'])->name('settings');
    Route::put('/settings', [AdminController::class, 'updateAccount'])->name('settings.update');
    Route::put('/settings/password', [AdminController::class, 'updatePassword'])->name('settings.password');
    
    });

//technician
Route::prefix('technician')->name('technician.')->group(function () {
    Route::get('/login', [TechnicianController::class, 'login'])->name('login');
    Route::post('/authenticate', [TechnicianController::class, 'authenticate'])->name('authenticate');
    Route::get('/dashboard', [TechnicianController::class, 'dashboard'])->name('dashboard');
    Route::get('/reports', [TechnicianController::class, 'reports'])->name('reports');
    Route::post('/logout', [TechnicianController::class, 'logout'])->name('logout');

    Route::get('/assignments', [TechnicianController::class, 'assignments'])->name('assignments');
    Route::get('/assignments/{id}', [TechnicianController::class, 'assignmentDetail'])->name('assignment.detail');
    Route::post('/assignments/{id}/start', [TechnicianController::class, 'startAssignment'])->name('assignment.start');
    Route::get('/assignments/{id}/maintenance/create', [TechnicianController::class, 'createMaintenanceRecord'])
    ->name('maintenance.create');

    Route::get('/maintenance-records', [TechnicianController::class, 'maintenanceRecords'])->name('maintenance.records');
    Route::post('/assignments/{id}/maintenance', [TechnicianController::class, 'storeMaintenanceRecord'])
    ->name('maintenance.store');
    Route::get('/maintenance-record/{id}', [TechnicianController::class, 'maintenanceRecordDetail'])
    ->name('maintenance.detail');

});