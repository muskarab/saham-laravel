<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Emiten;
use App\Models\InstrumentSaham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $sim_kon = array();
        $user_logins = User::where('id', Auth::user()->id)->get();
        $not_user_logins = User::where('role', '!=', 'admin')->where('id', '!=', Auth::user()->id)->get();
        foreach ($user_logins as $user_login) {
            foreach ($not_user_logins as $not_user_login) {
                $sim_kon[] = ["name" => $not_user_login->name, "sim" => (($user_login->w_eps_kon * $not_user_login->w_eps_kon) + ($user_login->w_roe_kon * $not_user_login->w_roe_kon) + ($user_login->w_per_kon * $not_user_login->w_per_kon)) / (sqrt(pow($user_login->w_eps_kon, 2) + pow($user_login->w_roe_kon, 2) + pow($user_login->w_per_kon, 2)) * sqrt(pow($not_user_login->w_eps_kon, 2) + pow($not_user_login->w_roe_kon, 2) + pow($not_user_login->w_per_kon, 2)))];
            }
        }
        // dd($sim_kon, $user_logins, $not_user_logins);
        // $count_sim_kon = count($sim_kon);
        // for ($i=0; $i < $count_sim_kon ; $i++) {
        //     if ($sim_kon[$i]['sim'] > $sim_kon[1]['sim']) {
        //         print_r($sim_kon[$i]['name']);
        //     }
        // }
        // $max = max(array_map(function ($sim_kon) {
        //     return $sim_kon['sim'];
        // },
        //     $sim_kon
        // ));
        $max_sim = $sim_kon[array_search(max($prices = array_column($sim_kon, 'sim')), $prices)];
        $get_user_sim = User::where('name', $max_sim['name'])->get();
        // dd($sim_kon, $get_user_sim);
        $instruments = InstrumentSaham::get();
        return view('profile.edit', compact('instruments'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('You are not allowed to change the password for a default user.')]);
        }

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function similarity(Request $request)
    {
        // dd($request->all());
        $user = User::findOrFail(Auth::user()->id);
        if ($user->instrument_saham_id == 3) {
            $user->update([
                'w_eps_kon' => $request->w_eps_kon,
                'w_roe_kon' => $request->w_roe_kon,
                'w_per_kon' => $request->w_per_kon,
                'w_eps_syar' => $request->w_eps_syar,
                'w_roe_syar' => $request->w_roe_syar,
                'w_der_syar' => $request->w_der_syar,
            ]);
        }elseif ($user->instrument_saham_id == 1) {
            $user->update([
                'w_eps_kon' => $request->w_eps_kon,
                'w_roe_kon' => $request->w_roe_kon,
                'w_per_kon' => $request->w_per_kon,
            ]);
        }elseif ($user->instrument_saham_id == 2) {
            $user->update([
                'w_eps_syar' => $request->w_eps_syar,
                'w_roe_syar' => $request->w_roe_syar,
                'w_der_syar' => $request->w_der_syar,
            ]);
        }

        $emiten_kons = Emiten::where('index_id', 1)->get();
        $emiten_syars = Emiten::where('index_id', 2)->get();
        if (Auth::user()->instrument_saham_id == 1) {
            //update vektor s
            foreach ($emiten_kons as $emiten_kon) {
                $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                $w_total = $w_eps * $w_roe * $w_per;
                DB::table('vektor_s')
                ->where('user_id', $user->id)
                ->where('emiten_id',
                    $emiten_kon->id
                )
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
            ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
            ->get();
            foreach ($vektor_s_kons as $vektor_s_kon) {
                DB::table('vektor_v_s')
                    ->where('user_id', $user->id)
                    ->where('emiten_id',
                        $vektor_s_kon->id
                    )
                    ->update([
                        'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                        'updated_at' => now()
                    ]);
            }
        } elseif (Auth::user()->instrument_saham_id == 2) {
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
            ->where('index_id', 2)
            ->where('vektor_s.user_id', $user->id)
            ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
            ->get();
            foreach ($vektor_s_syars as $vektor_s_syar) {
                DB::table('vektor_v_s')
                ->where('user_id', $user->id)
                ->where('emiten_id',
                    $vektor_s_syar->id
                )
                ->update([
                    'vektor_v' => $vektor_s_syar->vektor_s / $sum_vektor_s_syar,
                    'updated_at' => now()
                ]);
            }
        } elseif (Auth::user()->instrument_saham_id == 3) {
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
            ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
            ->get();
            foreach ($vektor_s_kons as $vektor_s_kon) {
                DB::table('vektor_v_s')
                ->where('user_id', $user->id)
                ->where('emiten_id',
                    $vektor_s_kon->id
                )
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
            ->where('index_id', 2)
                ->where('vektor_s.user_id', $user->id)
                ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                ->get();
            foreach ($vektor_s_syars as $vektor_s_syar) {
                DB::table('vektor_v_s')
                ->where('user_id', $user->id)
                ->where('emiten_id',
                    $vektor_s_syar->id
                )
                ->update([
                    'vektor_v' => $vektor_s_syar->vektor_s / $sum_vektor_s_syar,
                    'updated_at' => now()
                ]);
            }
        }
        return back();
    }
}
