<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\IndexSaham;
use App\Models\Sektor;
use App\Models\VektorS;
use App\Models\VektorV;
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
        $sectors = Sektor::get();
        $emitens = Emiten::get();
        $konvensionals = $emitens->where('index_id', 1);
        $syariahs = $emitens->where('index_id', 2);
        // $final_kon = Emiten::where('index_id', 1)->get();
        // $final_syar = Emiten::where('index_id', 2)->get();

        $years = IndexSaham::distinct('tahun')->get('tahun');

        $final_kons = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_id', 1)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*', 'vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'sektors.name as sektor')
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
        ->select('emitens.*','vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->get();

        // $vektor_s_user = VektorS::where('user_id', Auth::user()->id)->get();
        // $lastdata_emiten_kon = Emiten::where('index_id', 1)->orderBy('id', 'DESC')->first();
        // $lastdata_vektor_v = VektorS::where('user_id', 2)->orderBy('id', 'DESC')->first();
        // dd($sum_vektor_s_syar);
        return view('dashboard.index', compact('sectors', 'emitens', 'konvensionals', 'syariahs', 'final_kons', 'final_syar', 'years'))->with('i')->with('j');
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
        $emitens = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('emitens.id', $emitens)
        ->select('emitens.*', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'sektors.name as sektor')
        ->orderByRaw('vektor_v DESC')->get();
        // dd($emitens);
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
