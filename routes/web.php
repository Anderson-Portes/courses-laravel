<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('', function () {
  return redirect('home');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("cursos", CourseController::class);

Route::resource("alunos", StudentController::class);

Route::get('pdf', [PdfController::class, 'index'])->name('pdf');
Route::get('/alunos/pdf/{id}', [PdfController::class, 'studentPdf'])->name('student.pdf');

Route::get('excel', [ExcelController::class, 'index'])->name('excel');
Route::get('/alunos/excel/{id}', [ExcelController::class, 'studentExcel'])->name('student.excel');

Route::get('pagar-boleto/{id}', [PaymentController::class, 'paymentViaTicket'])->name('boleto');

Route::put('atualizar-status/{id}', [StudentController::class, 'updateStatus'])->name('status');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/alunos/cursos/{id}', [PurchaseController::class, 'studentPurchases'])->name('student.purchases');
Route::post('/alunos/cursos/{id}', [PurchaseController::class, 'addStudentPurchase'])->name('student.purchases.store');
Route::delete('/alunos/cursos/{id}', [PurchaseController::class, 'deleteStudentPurchase'])
  ->name('student.purchases.destroy');
Route::put('/alunos/cursos/{id}', [PurchaseController::class, 'updateStudentPurchaseStatus'])
  ->name('student.purchases.update');
