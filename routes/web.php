<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome')->name('home');
});
Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'studentRegister'])->name('studentRegister');

Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'userlogin'])->name('userLogin');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware'=>['web', 'checkAdmin']], function(){
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashoard']);
       

    //Course Route
    Route::post('/add-course',[AdminController::class, 'addCourse'])->name('addCourse');
    Route::get('/edit/{course}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/edit/{course}',[AdminController::class, 'editCourse'])->name('editCourse');
    Route::delete('/delete/{course}',[AdminController::class, 'deleteCourse'])->name('deleteCourse');

    //Exam Route
    Route::get('/admin/exam', [AdminController::class, 'examDashboard']);
    Route::post('/add-exam',[AdminController::class, 'addExam'])->name('addExam');
    Route::put('/edit-exam',[AdminController::class, 'addExam'])->name('editExam');
    Route::delete('/delete-exam/{exam}',[AdminController::class, 'deleteExam'])->name('deleteExam');


    //Question and Answer Route
    Route::get('/admin/qna', [AdminController::class, 'qnaDashboard']);


});

Route::group(['middleware'=>['web', 'checkStudent']], function(){
    Route::get('/dashboard', [AuthController::class, 'loadDashoard']);
});

Route::group(['middleware'=>['web', 'checkCord']], function(){
    Route::get('/cord/dashboard', [AuthController::class, 'cordDashboard']);
});


