<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check_user_type:Usuário');
    }

    public function paymentViaTicket()
    {
        $description = "Pagamento do curso " . Auth::user()->student->course->name . " no valor de R$ " . Auth::user()->student->course->price;
        $json = Http::withHeaders([
            "Authorization" => "0D84518F5F6B4EC0B5DB5565938FF0F4",
            "Content-Type" => "application/json"
        ])->post('https://sandbox.api.pagseguro.com/charges', [
            'reference_id' => sha1(rand(0, time()) . time()),
            'description' =>  $description,
            'amount' => [
                'value' => Auth::user()->student->course->price * 100,
                'currency' => 'BRL'
            ],
            'payment_method' => [
                'type' => 'BOLETO',
                'boleto' => [
                    'due_date' => Auth::user()->student->course->end_date,
                    'holder' => [
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'tax_id' => Auth::user()->student->cpf,
                        'address' => [
                            'street' => Auth::user()->student->address->complement,
                            'number' => Auth::user()->student->address->number,
                            'locality' => Auth::user()->student->address->district,
                            'city' => Auth::user()->student->address->city,
                            'region' => Auth::user()->student->address->state,
                            'region_code' => Auth::user()->student->address->state,
                            'country' => 'Brasil',
                            'postal_code' => Auth::user()->student->address->cep
                        ]
                    ]
                ]
            ]
        ]);
        return redirect($json['links'][0]['href']);
    }
}
