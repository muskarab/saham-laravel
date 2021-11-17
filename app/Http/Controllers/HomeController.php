<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\Sektor;
use Illuminate\Http\Request;
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
        $emitens = Emiten::paginate(5);
        $konvensionals = $emitens->where('index_id', 1);
        $syariahs = $emitens->where('index_id', 2);
        // $final_kon = Emiten::where('index_id', 1)->get();
        $final_syar = Emiten::where('index_id', 2)->get();

        $final_kons = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_id', 1)
        ->select('emitens.*', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'sektors.name as sektor')
        ->orderByRaw('vektor_v DESC')->get();

        $final_syar = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_id', 2)
        ->select('emitens.*', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'sektors.name as sektor')
        ->orderByRaw('vektor_v DESC')->get();
        // dd($final_kon);
        return view('dashboard.index', compact('sectors', 'emitens', 'konvensionals', 'syariahs', 'final_kons', 'final_syar'))->with('i')->with('j');
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
