<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Emiten;
use App\Models\InstrumentSaham;
use App\Models\User;
use App\Models\VektorS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $instruments = InstrumentSaham::get();
        return view('user.edit', compact('user', 'instruments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'name' => ['required'],
        //     'email' => ['required'],
        //     'address' => ['required'],
        //     'date_of_birth' => ['required'],
        //     'role' => ['required'],
        // ]);
        
        $user = User::findOrFail(Auth::user()->id);

        if ($user->instrument_saham_id == 3) {
            if ($user->id == Auth::user()->id) {
                $user->update([
                    'name' => request('name'),
                    'email' => request('email'),
                    'address' => request('address'),
                    // 'date_of_birth' => Carbon::createFromFormat('m/d/Y', $request['date_of_birth'])->format('Y-m-d'),
                    'gender' => request('gender'),
                    'instrument_saham_id' => request('instrument'),
                    'w_eps_kon' => request('w_eps_kon'),
                    'w_roe_kon' => request('w_roe_kon'),
                    'w_per_kon' => request('w_per_kon'),
                    'w_eps_syar' => request('w_eps_syar'),
                    'w_roe_syar' => request('w_roe_syar'),
                    'w_der_syar' => request('w_der_syar'),
                ]);
            }
        }elseif ($user->instrument_saham_id == 1) {
            if ($user->id == Auth::user()->id) {
                $user->update([
                    'name' => request('name'),
                    'email' => request('email'),
                    'address' => request('address'),
                    // 'date_of_birth' => Carbon::createFromFormat('m/d/Y', $request['date_of_birth'])->format('Y-m-d'),
                    'gender' => request('gender'),
                    'instrument_saham_id' => request('instrument'),
                    'w_eps_kon' => request('w_eps_kon'),
                    'w_roe_kon' => request('w_roe_kon'),
                    'w_per_kon' => request('w_per_kon'),
                ]);
            }
        } elseif ($user->instrument_saham_id == 2) {
            if ($user->id == Auth::user()->id) {
                $user->update([
                    'name' => request('name'),
                    'email' => request('email'),
                    'address' => request('address'),
                    // 'date_of_birth' => Carbon::createFromFormat('m/d/Y', $request['date_of_birth'])->format('Y-m-d'),
                    'gender' => request('gender'),
                    'instrument_saham_id' => request('instrument'),
                    'w_eps_syar' => request('w_eps_syar'),
                    'w_roe_syar' => request('w_roe_syar'),
                    'w_der_syar' => request('w_der_syar'),
                ]);
            }
        }

        $users = User::get();
        $emiten_kons = Emiten::where('index_id', 1)->get();
        $emiten_syars = Emiten::where('index_id', 2)->get();
        $lastdata_emiten = Emiten::orderBy('id', 'DESC')->first();
        $bobots = Bobot::where('instrument_saham_id','=', 1)->get();
        foreach ($users as $user) {
            if ($user->instrument_saham_id == 1) {
                //update vektor s
                foreach ($emiten_kons as $emiten_kon) {
                    $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                    $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                    $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                    $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_per;
                    DB::table('vektor_s')
                    ->where('user_id', $user->id)
                        ->where('emiten_id', $emiten_kon->id)
                        ->update([
                            'vektor_s' => $w_total,
                            'updated_at' => now()
                        ]);
                }
                //update vektor v
                $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->where('index_id', 1)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('vektor_s.vektor_s')
                    ->sum('vektor_s.vektor_s');
                $vektor_s_kons = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->where('index_id', 1)
                    ->where('vektor_s.user_id', $user->id)
                    ->select(
                        'emitens.*',
                        'vektor_s.user_id',
                        'vektor_s.vektor_s'
                    )
                    ->get();
                foreach ($vektor_s_kons as $vektor_s_kon) {
                    DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                        ->where('emiten_id', $vektor_s_kon->id)
                        ->update([
                            'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                            'updated_at' => now()
                        ]);
                }
            }
            if ($user->instrument_saham_id == 2) {
                //update vektor s
                foreach ($emiten_syars as $emiten_syar) {
                    $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
                    $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                    $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                    $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_der;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_syar->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                $sum_vektor_s_syar = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->where('index_id', 2)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('vektor_s.vektor_s')
                    ->sum('vektor_s.vektor_s');
                $vektor_s_syars = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->where('index_id',
                    2
                )
                ->where('vektor_s.user_id', $user->id)
                ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                ->get();
                foreach ($vektor_s_syars as $vektor_s_syar) {
                    DB::table('vektor_v_s')
                    ->where('user_id', $user->id)
                        ->where('emiten_id', $vektor_s_syar->id)
                        ->update([
                            'vektor_v' => $vektor_s_syar->vektor_s / $sum_vektor_s_syar,
                            'updated_at' => now()
                        ]);
                }
            }
            if ($user->instrument_saham_id == 3) {
                //update vektor s
                foreach ($emiten_kons as $emiten_kon) {
                    $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                    $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                    $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                    $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_per;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_kon->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                $sum_vektor_s_kon = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->where('index_id', 1)
                ->where('vektor_s.user_id', $user->id)
                    ->select('vektor_s.vektor_s')
                    ->sum('vektor_s.vektor_s');
                $vektor_s_kons = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->where('index_id', 1)
                    ->where('vektor_s.user_id', $user->id)
                    ->select(
                        'emitens.*',
                        'vektor_s.user_id',
                        'vektor_s.vektor_s'
                    )
                    ->get();
                foreach ($vektor_s_kons as $vektor_s_kon) {
                    DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                        ->where('emiten_id', $vektor_s_kon->id)
                        ->update([
                            'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                            'updated_at' => now()
                        ]);
                }
                //update vektor s
                foreach ($emiten_syars as $emiten_syar) {
                    $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
                    $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                    $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                    $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_der;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_syar->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                $sum_vektor_s_syar = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->where('index_id', 2)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('vektor_s.vektor_s')
                    ->sum('vektor_s.vektor_s');
                $vektor_s_syars = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->where('index_id',
                    2
                )
                ->where('vektor_s.user_id', $user->id)
                ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                ->get();
                foreach ($vektor_s_syars as $vektor_s_syar) {
                    DB::table('vektor_v_s')
                    ->where('user_id', $user->id)
                        ->where('emiten_id', $vektor_s_syar->id)
                        ->update([
                            'vektor_v' => $vektor_s_syar->vektor_s / $sum_vektor_s_syar,
                            'updated_at' => now()
                        ]);
                }
            }
        }

        return redirect()->route('user.index')->with('success', 'User updated success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted success');
    }
}
