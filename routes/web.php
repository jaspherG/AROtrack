<?php


/* Middleware */
use App\Http\Middleware\CheckAuthUsers;
use App\Http\Middleware\CheckAuthAdmin;
/* Controllers */
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
Route::middleware([CheckAuthUsers::class])->group(function () {
	Route::get('program/{id}', [HomeController::class, 'program'])->name('program');
});

Route::middleware([CheckAuthAdmin::class])->group(function () {
	Route::get('student-management', [HomeController::class, 'StudentManagement'])->name('StudentManagement');
	Route::get('/student-management/{id}', [HomeController::class, 'showServiceManagement'])->name('show.requirements');

	Route::get('admission', [HomeController::class, 'admission'])->name('admission');
	Route::get('/student-management/{id}', [HomeController::class, 'showServiceManagement'])->name('show.requirements');

	Route::get('student-list', [HomeController::class, 'StudentList'])->name('Student-List');
	Route::get('student-list/{program}', [HomeController::class, 'filterStudentList'])->name('Student-List-Program');
	Route::get('student/{name}', [HomeController::class, 'editStudent'])->name('edit.student');

	Route::get('freshman', [HomeController::class, 'freshman'])->name('freshman');
	Route::get('freshman/{id}', [HomeController::class, 'editFreshman'])->name('edit.freshman');
	
	Route::get('returnee', [HomeController::class, 'reAdmission'])->name('returnee');
	Route::get('returnee/{id}', [HomeController::class, 'editReAdmission'])->name('edit.returnee');

	Route::get('transferee', [HomeController::class, 'transferee'])->name('transferee');
	Route::get('transferee/{id}', [HomeController::class, 'editTransferee'])->name('edit.transferee');

	Route::get('cross-enroll', [HomeController::class, 'CrossEnroll'])->name('cross-enroll');
	Route::get('cross-enroll/{id}', [HomeController::class, 'editCrossEnroll'])->name('edit.cross-enroll');

	Route::get('newstudent', [HomeController::class, 'newstudent'])->name('newstudent');
	Route::get('newstudent/{id}', [HomeController::class, 'editnewstudent'])->name('edit.newstudent ');

	Route::get('/completed/{service}', [HomeController::class, 'completed'])->name('completed');
	Route::get('/completed/{service}/{program}', [HomeController::class, 'completedFilter'])->name('completed-filter');
	// Route::get('completed/{id}', [HomeController::class, 'editcompleted'])->name('edit.completed ');

	Route::get('deficiency/{service}', [HomeController::class, 'deficiency'])->name('deficiency');
	Route::get('deficiency/{service}/{program}', [HomeController::class, 'deficiencyFilter'])->name('deficiency-filter');
	// Route::get('deficiency/{id}', [HomeController::class, 'editdeficiency'])->name('edit.deficiency');

	
	Route::get('overall-student/{service}', [HomeController::class, 'overallStudent'])->name('all-students');
	Route::get('overall-student/{service}/{program}', [HomeController::class, 'filterOverallStudent'])->name('f-all-students');

	// Route::get('overallstudent/', [HomeController::class, 'overallstudent'])->name('overallstudent');
	// Route::get('overallstudent/{id}', [HomeController::class, 'editoverallstudent'])->name('edit.overallstudent');

	// save requirement
	Route::post('/requirement', [HomeController::class, 'storeRequirement'])->name('store.requirement');
	Route::put('/requirement', [HomeController::class, 'updateRequirement'])->name('update.requirement');

	Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

	// report 
	Route::get('service-export', [ReportController::class, 'exportService'])->name('service.export');
});

Route::group(['middleware' => 'auth'], function () {

  Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', [HomeController::class, 'viewDashboard'])->name('dashboard');	

	Route::get('reports', [HomeController::class, 'report'])->name('reports');
	Route::get('reports/{status}', [HomeController::class, 'dashboardReport'])->name('dashboard-reports');

	
	Route::get('profile', [HomeController::class, 'profile'])->name('profile');

  Route::get('static-sign-in', function () {
		return view('laravel-examples/user-management');
	})->name('sign-in');

  Route::get('static-sign-up', function (Request $request) {
		$user = $request->user();
		return view('static-sign-up',  compact(['user']));
	})->name('sign-up');

  Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::put('/user-profile', [InfoUserController::class, 'update']);
	Route::post('/user-delete', [InfoUserController::class, 'destroy']);

	Route::prefix('html-function')->group(function(){
		Route::get('{id}', [HomeController::class, 'htmlFunctions'])->name('html-functions');
	});

	Route::get('/generate-report', [ReportController::class, 'generateReport'])->name('print.admission.report');
});

Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', function () {
		return view('session/login-session');
	})->name('login')->middleware('login.attempts');
  Route::post('/login', [SessionsController::class, 'login'])->middleware('login.attempts');
	Route::post('enabled_login', [SessionsController::class, 'enabledLogin']);
  Route::post('/login-session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::post('/auth/user/reset-password', [AuthController::class, 'resetPassword']);


