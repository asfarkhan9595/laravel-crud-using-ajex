<?php

use App\Http\Controllers\StudentController;
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



Route::get('/add-student',function(){
    return view ('form');
});

Route::post('/add-student',[StudentController::class,'addstudent'])->name('addstudent');
Route::get('/',[StudentController::class,'index'])->name('students');
Route::get('/get-student',[StudentController::class,'getstudent'])->name('getstudent'); 
Route::get('/edit/{id}',[StudentController::class,'edit'])->name('edit-student'); 
Route::post('/updateStudent',[StudentController::class,'update'])->name('updateStudent'); 
Route::get('/delete/{id}', [StudentController::class,'destroy'])->name('students.destroy');
