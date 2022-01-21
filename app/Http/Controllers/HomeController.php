<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\IndexSaham;
use App\Models\Sektor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indexs = IndexSaham::get();
        $emiten_kons = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 1)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        $emiten_syars = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 2)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        // if (Auth::user()->instrument_saham_id == 1) {
        //     //Konvensional

        //Perhitungan Vektor S
        foreach ($emiten_kons as $emiten_kon) {
            $w_user_total = Auth::user()->w_eps_kon + Auth::user()->w_roe_kon + Auth::user()->w_per_kon;
            $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - (Auth::user()->w_eps_kon / $w_user_total));
            $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], (Auth::user()->w_roe_kon / $w_user_total));
            $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], (Auth::user()->w_per_kon / $w_user_total));
            $w_total = $w_eps * $w_roe * $w_per;
            DB::table('vektor_s')
            ->where('user_id', 0)
            ->where('emiten_id', $emiten_kon->id)
            ->update([
                'user_id' => Auth::user()->id,
                'vektor_s' => $w_total,
                'updated_at' => now()
            ]);
        }
        foreach ($emiten_syars as $emiten_syar) {
            $w_user_total = Auth::user()->w_eps_syar + Auth::user()->w_roe_syar + Auth::user()->w_der_syar;
            $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], (Auth::user()->w_eps_syar / $w_user_total));
            $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], (Auth::user()->w_roe_syar / $w_user_total));
            $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], (Auth::user()->w_der_syar / $w_user_total));
            $w_total = $w_eps * $w_roe * $w_der;
            DB::table('vektor_s')
            ->where('user_id', 0)
            ->where('emiten_id', $emiten_syar->id)
            ->update([
                'user_id' => Auth::user()->id,
                'vektor_s' => $w_total,
                'updated_at' => now()
            ]);
        }

        //Perhitungan Vektor V
        foreach ($indexs as $index) {
            $sum_vektor_s_kon = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                ->where('index_sahams.id', $index->id)
                ->where('vektor_s.user_id', Auth::user()->id)
                ->select('vektor_s.vektor_s')
                ->sum('vektor_s.vektor_s');
            $vektor_s_kons = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                ->where('index_sahams.id', $index->id)
                ->where('vektor_s.user_id', Auth::user()->id)
                ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                ->get();
            foreach ($vektor_s_kons as $vektor_s_kon) {
                DB::table('vektor_v_s')
                ->where('user_id', 0)
                ->where('emiten_id', $vektor_s_kon->id)
                ->update([
                    'user_id' => Auth::user()->id,
                    'emiten_id' => $vektor_s_kon->id,
                    'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        $sectors = Sektor::get();
        $emitens = Emiten::get();
        $konvensionals = $emitens->where('index_id', 1);
        $syariahs = $emitens->where('index_id', 2);

        $years = IndexSaham::distinct('tahun')->get('tahun');

        $final_kons = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_sahams.instrument_saham_id', 1)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*', 'vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'index_sahams.tahun as tahun', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->get();

        $final_syar = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_id', 2)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*','vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index','index_sahams.tahun as tahun', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->get();

        $user_login = User::where('id', Auth::user()->id)->get();
        $not_user_login = User::where('role', '!=', 'admin')->where('id', '!=', Auth::user()->id)->get();
        dd($not_user_login, $user_login);

        // return view('dashboard.index', compact('sectors', 'emitens', 'konvensionals', 'syariahs', 'final_kons', 'final_syar', 'years'))->with('i')->with('j');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($emitens)
    {
        $emitens = Emiten::where('id', $emitens)->get();
        return view('dashboard.show', compact('emitens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
