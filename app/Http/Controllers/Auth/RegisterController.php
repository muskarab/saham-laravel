<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Emiten;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date_of_birth' => ['required', 'string',],
            'instrument_saham' => ['required'],
            'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $emiten_kons = Emiten::where('index_id', 1)->get();
        $emiten_syars = Emiten::where('index_id', 2)->get();
        if ($data['instrument_saham'] == 1) {
            foreach ($emiten_kons as $emiten_kon) {
                DB::table('vektor_s')->insert([
                    'emiten_id' => $emiten_kon->id,
                    'user_id' => 0,
                    'vektor_s' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                DB::table('vektor_v_s')->insert([
                    'emiten_id' => $emiten_kon->id,
                    'user_id' => 0,
                    'vektor_v' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            return User::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'email' => $data['email'],
                'date_of_birth' => Carbon::createFromFormat('m/d/Y', $data['date_of_birth'])->format('Y-m-d'),
                'instrument_saham_id' => $data['instrument_saham'],
                'gender' => $data['gender'],
                'password' => Hash::make($data['password']),
                'w_eps_kon' => 6,
                'w_roe_kon' => 6,
                'w_per_kon' => 2,
                'w_der_kon' => 0,
                'w_eps_syar' => 0,
                'w_roe_syar' => 0,
                'w_per_syar' => 0,
                'w_der_syar' => 0,
            ]);
        }
        elseif ($data['instrument_saham'] == 2) {
            foreach ($emiten_syars as $emiten_syar) {
                DB::table('vektor_s')->insert([
                    'emiten_id' => $emiten_syar->id,
                    'user_id' => 0,
                    'vektor_s' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                DB::table('vektor_v_s')->insert([
                    'emiten_id' => $emiten_syar->id,
                    'user_id' => 0,
                    'vektor_v' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            return User::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'email' => $data['email'],
                'date_of_birth' => Carbon::createFromFormat('m/d/Y', $data['date_of_birth'])->format('Y-m-d'),
                'instrument_saham_id' => $data['instrument_saham'],
                'gender' => $data['gender'],
                'password' => Hash::make($data['password']),
                'w_eps_kon' => 0,
                'w_roe_kon' => 0,
                'w_per_kon' => 0,
                'w_der_kon' => 0,
                'w_eps_syar' => 3,
                'w_roe_syar' => 4,
                'w_per_syar' => 0,
                'w_der_syar' => 7,
            ]);
        }
        elseif ($data['instrument_saham'] == 3) {
            foreach ($emiten_kons as $emiten_kon) {
                DB::table('vektor_s')->insert([
                    'emiten_id' => $emiten_kon->id,
                    'user_id' => 0,
                    'vektor_s' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                DB::table('vektor_v_s')->insert([
                    'emiten_id' => $emiten_kon->id,
                    'user_id' => 0,
                    'vektor_v' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            foreach ($emiten_syars as $emiten_syar) {
                DB::table('vektor_s')->insert([
                    'emiten_id' => $emiten_syar->id,
                    'user_id' => 0,
                    'vektor_s' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                DB::table('vektor_v_s')->insert([
                    'emiten_id' => $emiten_syar->id,
                    'user_id' => 0,
                    'vektor_v' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            return User::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'email' => $data['email'],
                'date_of_birth' => Carbon::createFromFormat('m/d/Y', $data['date_of_birth'])->format('Y-m-d'),
                'instrument_saham_id' => $data['instrument_saham'],
                'gender' => $data['gender'],
                'password' => Hash::make($data['password']),
                'w_eps_kon' => 6,
                'w_roe_kon' => 6,
                'w_per_kon' => 2,
                'w_der_kon' => 0,
                'w_eps_syar' => 3,
                'w_roe_syar' => 4,
                'w_per_syar' => 0,
                'w_der_syar' => 7,
            ]);
        }
    }
}
