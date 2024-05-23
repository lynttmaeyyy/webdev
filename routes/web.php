<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->middleware('auth')->name('home');
Route::get('/leave-types', [LeaveTypeController::class, 'index'])->middleware('auth');


Route::get('/users-leave', [LeaveController::class, 'index'])->middleware('auth')->name('leaves');
Route::put('/users-leave/reject/{id}', [LeaveController::class, 'reject'])->middleware('auth')->name('rejectleaves');
Route::put('/users-leave/approve/{id}', [LeaveController::class, 'approve'])->middleware('auth')->name('approveleaves');


Route::post('/employees', [EmployeeController::class, 'store'])->middleware('auth')->name('employees.store');
Route::get('/employee', [EmployeeController::class, 'index'])->middleware('auth')->name('employee');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->middleware('auth')->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->middleware('auth')->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->middleware('auth')->name('employees.destroy');

Route::post('/departments', [DepartmentController::class, 'store'])->middleware('auth')->name('departments.store');
Route::get('/departments', [DepartmentController::class, 'index'])->middleware('auth')->name('departments');
Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->middleware('auth')->name('departments.edit');
Route::put('/departments/{id}', [DepartmentController::class, 'update'])->middleware('auth')->name('departments.update');
Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->middleware('auth')->name('departments.destroy');

Route::post('/leavetypes', [LeaveTypeController::class, 'store'])->middleware('auth')->name('leavetypes.store');
Route::get('/leavetype', [LeaveTypeController::class, 'index'])->middleware('auth')->name('leavetype');
Route::get('/leavetypes/{id}/edit', [LeaveTypeController::class, 'edit'])->middleware('auth')->name('leavetypes.edit');
Route::put('/leavetypes/{id}', [LeaveTypeController::class, 'update'])->middleware('auth')->name('leavetypes.update');
Route::delete('/leavetypes/{id}', [LeaveTypeController::class, 'destroy'])->middleware('auth')->name('leavetypes.destroy');




Route::group(['middleware' => 'auth'], function () {
	Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::post('/google', [GoogleController::class, 'googleAuth']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('dashboard', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

Route::post('/login', [LoginController::class, 'ajaxLogin'])->name('ajaxLogin');

Route::post('/login', [LoginController::class, 'login'])->middleware('throttle_login');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::post('google/login', [LoginController::class, 'verify_login_email'])->name('google.authorization');


Route::get('/fileleave', '\App\Http\Controllers\LeaveController@fileleave')->name('fileleave');
Route::post('/store', '\App\Http\Controllers\LeaveController@store')->name('storeleave');
Route::post('/save', '\App\Http\Controllers\LeaveController@save')->name('saveleave');
Route::get('/getleave/{id}', '\App\Http\Controllers\LeaveController@getleave')->name('getleave');
Route::delete('/leave/delete/{id}', '\App\Http\Controllers\LeaveController@delete')->name('deleteleave');
