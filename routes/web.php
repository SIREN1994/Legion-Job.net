<?php

use App\Models\Jobs;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

//URLS//

Route::get('/', function () {
    // Fetch the jobs paginated with 5 jobs per page
    $jobs = Jobs::paginate(5);

    // Pass the paginated jobs data to the view
    return view('home', ['jobs' => $jobs]);
});

Route::get('/form', function () {
    return view('Register_Login');
});


Route::get('/signup', function () {
    return view('Register_Login');
});

Route::get('/addjobs', function () {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return view("Admin.adminlogin");
    }
    return view('Admin.Add_Jobs');
});

Route::get('/editjobs', function () {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return view("Admin.adminlogin");
    }
    $jobs = Jobs::paginate(6);
    return view('Admin.Edit_Jobs', ['jobs' => $jobs]);
});

Route::get('/deletejobs', function () {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return view("Admin.adminlogin");
    }
    return view('Admin.Delete_Jobs');
});

Route::get('/auth', function () {
    return view('authtest');
});



//JOBS//
Route::post('/addjobs', [JobsController::class, 'addjobs']);
Route::get('/jobs_edit', [JobsController::class, 'jobedit']);
Route::post('/updatejob', [JobsController::class, 'updatejob']);
Route::post('/delete', [JobsController::class, 'delete']);
Route::get('/show/{value}', [JobsController::class, 'show']);
Route::get('/search', [JobsController::class, 'search']);
Route::get('/detailjob', [JobsController::class, 'detailjob']);
Route::get('/query1', [JobsController::class, 'query1']);
Route::post('/applyjob', [JobsController::class, 'applyjob']);



//Clients//
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/loginX', [UserController::class, 'loginX']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/uploadcv', [UserController::class, 'uploadcv']);
Route::post('/updatecv', [UserController::class, 'updatecv']);
Route::get('/viewprofile', [UserController::class, 'viewprofile']);
Route::post('/uploadpfp', [UserController::class, 'uploadpfp']);


//Admins
Route::get('/applicants', [AdminController::class, 'applicants']);
Route::post('/adminlogin', [AdminController::class, 'adminlogin']);
Route::post('/adminlogout', [AdminController::class, 'adminlogout']);
Route::get('/admin', function () {
    return view('Admin.adminlogin');
});

Route::get('/adminpage', function () {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return view("Admin.adminlogin");
    }
    return view('Admin.adminpanel');
});

Route::get('/overview', function () {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return view("Admin.adminlogin");
    }
    $jobs = Jobs::all()->count();
    $clients = Client::all()->count();
    return view('Admin.overview', compact('jobs', 'clients'));
});

Route::post('/downcv', [AdminController::class, 'downcv']);
Route::get('/datefilter', [AdminController::class, 'datefilter']);
