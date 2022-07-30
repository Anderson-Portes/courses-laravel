<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PdfController;
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

Route::get('excel', [ExcelController::class, 'index'])->name('excel');

Route::get('pagar-boleto', [PaymentController::class, 'paymentViaTicket'])->name('boleto');

Route::put('atualizar-status/{id}', [StudentController::class, 'updateStatus'])->name('status');
/*
const sdk = require('api')('@devpagseguro/v2.0#3izr7l2skylmkrvs');

sdk.createCharge({
  amount: {currency: 'BRL', value: 10000},
  payment_method: {
    card: {
      holder: {name: 'Anderson Portes'},
      number: 'https://sandbox.pagseguro.uol.com.br/comprador-de-testes.html#:~:text=4111111111111111',
      exp_month: 12,
      exp_year: 2030,
      security_code: '123'
    },
    type: 'CREDIT_CARD',
    installments: 1,
    capture: false
  },
  reference_id: 'user_123',
  description: 'Cobrança do curso tal de valor tal'
})
  .then(res => console.log(res))
  .catch(err => console.error(err));


  {
  "id": "CHAR_0C6306A8-E3C9-42F0-A0F2-289F7A1B5650",
  "reference_id": "user_123",
  "status": "AUTHORIZED",
  "created_at": "2022-07-29T18:12:26.488-03:00",
  "description": "",
  "amount": {
    "value": 10000,
    "currency": "BRL",
    "summary": {
      "total": 10000,
      "paid": 0,
      "refunded": 0
    }
  },
  "payment_response": {
    "code": "20000",
    "message": "SUCESSO",
    "reference": "032416400102"
  },
  "payment_method": {
    "type": "CREDIT_CARD",
    "installments": 1,
    "capture": false,
    "capture_before": "2022-08-03T18:12:28.677-03:00",
    "card": {
      "brand": "visa",
      "first_digits": "411111",
      "last_digits": "1111",
      "exp_month": "12",
      "exp_year": "2030",
      "holder": {
        "name": "Anderson Portes"
      }
    },
    "soft_descriptor": "sellervirtual"
  },
  "notification_urls": [],
  "links": [
    {
      "rel": "SELF",
      "href": "https://sandbox.api.pagseguro.com/charges/CHAR_0C6306A8-E3C9-42F0-A0F2-289F7A1B5650",
      "media": "application/json",
      "type": "GET"
    },
    {
      "rel": "CHARGE.CANCEL",
      "href": "https://sandbox.api.pagseguro.com/charges/CHAR_0C6306A8-E3C9-42F0-A0F2-289F7A1B5650/cancel",
      "media": "application/json",
      "type": "POST"
    },
    {
      "rel": "CHARGE.CAPTURE",
      "href": "https://sandbox.api.pagseguro.com/charges/CHAR_0C6306A8-E3C9-42F0-A0F2-289F7A1B5650/capture",
      "media": "application/json",
      "type": "POST"
    }
  ]
}
*/