<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cpf' => ['required', 'cpf', 'unique:students'],
            'phone' => ['required', 'numeric'],
            'telephone' => ['required', 'numeric'],
            'company' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'city' => 'required|string',
            'state' => 'required|string|max:2',
            'district' => 'required|string',
            'complement' => 'required|string',
            'number' => 'required|string',
            'cep' => 'required|numeric|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $address = Address::create([
            'cep' => $data['cep'],
            'state' => $data['state'],
            'city' => $data['city'],
            'district' => $data['district'],
            'number' => $data['number'],
            'complement' => $data['complement']
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'Usuário'
        ]);

        Student::create([
            'cpf' => $data['cpf'],
            'category' => $data['category'],
            'company' => $data['company'],
            'address_id' => $address->id,
            'phone' => $data['phone'],
            'telephone' => $data['telephone'],
            'user_id' => $user->id
        ]);

        return $user;
    }
}
