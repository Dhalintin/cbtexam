<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamController;


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

//Student Registration
Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'studentRegister'])->name('register');

//Admin Registration
Route::get('/adminreg', [AuthController::class, 'loadAdminReg']);
Route::post('/adminRegister', [AuthController::class, 'adminRegister'])->name('adminReg');

//Cordinators Registration
Route::get('/cordreg', [AuthController::class, 'loadCordReg']);

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
    Route::get('/admin/qna', [AdminController::class, 'qnaDashboard'])->name('viewQna');
    Route::get('/admin/qna/{course}', [AdminController::class, 'courseQna'])->name('courseQna');
    Route::post('/add-question',[AdminController::class, 'addQuestion'])->name('addQuestion');
    Route::put('/edit-question{question}',[AdminController::class, 'editQuestion'])->name('editQuestion');
    Route::post('/upload-question',[AdminController::class, 'uploadQuestion'])->name('uploadQuestion');
    Route::delete('/delete-question/{question}',[AdminController::class, 'deleteQuestion'])->name('deleteQuestion');

    //Students Route
    Route::get('/admin/students', [AdminController::class, 'students'])->name('students');


});

Route::group(['middleware'=>['web', 'checkStudent']], function(){
    Route::get('/dashboard', [AuthController::class, 'loadDashoard']);
    Route::post('/register/{id}', [ExamController::class, 'registerExam'])->name('registerExam');
    Route::get('/exam/{id}', [ExamController::class, 'loadExam'])->name('exam');
    Route::post('/exam-submit', [ExamController::class, 'examSubmit'])->name('examSubmit');
});

Route::group(['middleware'=>['web', 'checkCord']], function(){
    Route::get('/cord/dashboard', [AuthController::class, 'cordDashboard']);
});


