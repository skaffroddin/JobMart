<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs',[JobsController::class, 'index'])->name('jobs');
Route::get('/jobs/detail/{id}',[JobsController::class, 'detail'])->name('jobDetail');
Route::post('/apply-job', [JobsController::class, 'applyJob'])->name('applyJob');

Route::group(['prefix' => 'admin', 'middleware'=> 'checkRole'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/jobs', [JobController::class, 'index'])->name('admin.jobs');
    Route::get('/jobs/edit{id}', [JobController::class, 'edit'])->name('admin.jobs.edit');
    Route::post('/jobs{id}', [JobController::class, 'update'])->name('admin.jobs.update');
    Route::delete('/job-delete', [JobController::class, 'destroy'])->name('admin.jobs.destroy');
    Route::get('/job-application', [JobApplicationController::class, 'index'])->name('admin.jobApplication');
});

    Route::group(['middleware' => 'guest'], function(){
        Route::get('/register', [AccountController::class,'registration'])->name('account.registration');
        Route::post('/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
    });

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
        Route::post('/update-ProfilePic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::get('/create-job',[AccountController::class,'createJob'])->name('account.createJob');
        Route::post('/save-job',[AccountController::class, 'saveJob'])->name('account.saveJob');
        Route::get('/my-job',[AccountController::class, 'myJobs'])->name('account.myJobs');
        Route::get('/my-jobs/edit/{jobId}',[AccountController::class, 'editJobs'])->name('account.editJobs');
        Route::post('/update-job/{jobId}',[AccountController::class, 'updateJob'])->name('account.updateJob');
        Route::post('/delete-job',[AccountController::class, 'deleteJob'])->name('account.deleteJob');
        Route::get('/my-job-application', [AccountController::class, 'appliedJob'])->name('account.appliedJob');
        Route::post('/remove-job-application',[AccountController::class, 'removeJob'])->name('account.removeJob');
        Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');

        
    });
