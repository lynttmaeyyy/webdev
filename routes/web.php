<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\DepartmentController;


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
    return view('welcome');
});

Auth::routes();


Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/leave-types', [LeaveTypeController::class, 'index']);


Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/map', [EmployeeController::class, 'index'])->name('map');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/departments', [DepartmentController::class, 'index'])->name('profile.edit');
Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

Route::post('/leavetypes', [LeaveTypeController::class, 'store'])->name('leavetypes.store');
Route::get('/icons', [LeaveTypeController::class, 'index'])->name('icons');
Route::get('/leavetypes/{id}/edit', [LeaveTypeController::class, 'edit'])->name('leavetypes.edit');
Route::put('/leavetypes/{id}', [LeaveTypeController::class, 'update'])->name('leavetypes.update');
Route::delete('/leavetypes/{id}', [LeaveTypeController::class, 'destroy'])->name('leavetypes.destroy');




Route::group(['middleware' => 'auth'], function () {
	Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::post('/google', [GoogleController::class, 'googleAuth']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

Route::post('/login', [LoginController::class, 'ajaxLogin'])->name('ajaxLogin');

Route::post('/login', [LoginController::class, 'login'])->middleware('throttle_login');

Route::post('google/login', [LoginController::class, 'verify_login_email'])->name('google.authorization');


