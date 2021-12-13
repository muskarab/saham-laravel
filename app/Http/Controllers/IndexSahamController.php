<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Emiten;
use App\Models\IndexSaham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexSahamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $indexs = IndexSaham::get();
        // $bobots = Bobot::get();
        // return view('index_saham.index', compact('indexs', 'bobots'))->with('i')->with('j');
        $users = User::get();
        foreach ($users as $user) {
            if ($user->instrument_saham_id == 1) {
                $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->where('index_id', 1)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('vektor_s.user_id','vektor_s.vektor_s')
                    ->sum('vektor_s.vektor_s');
                $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->where('index_id', 1)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('emitens.*','vektor_s.user_id','vektor_s.vektor_s')
                    ->get();
                // echo $sum_vektor_s_kon;
                // foreach ($sum_vektor_s_kons as $sum_vektor_s_kon) {
                //     dd($sum_vektor_s_kon->all());
                // }
                dd($vektor_s_kons->all());
                // $emiten_kons = Emiten::where('index_id', 1)->get();
                foreach ($vektor_s_kons as $vektor_s_kon) {
                    DB::table('vektor_v_s')->insert([
                        'user_id' => $user->id,
                        'emiten_id' => $vektor_s_kon->id,
                        'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }

                // $sum_vektor_s_syar = DB::table('emitens')
                // ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                // ->where('index_id', 2)
                // ->select('vektor_s.vektor_s')
                // ->sum('vektor_s.vektor_s');
                // // echo $sum_vektor_s_syar;
                // $emiten_syars = Emiten::where('index_id', 2)->get();
                // foreach ($emiten_syars as $emiten_syar) {
                //     DB::table('vektor_v_s')->insert([
                //         'emiten_id' => $emiten_syar->id,
                //         'vektor_v' => $emiten_syar->vektor_s['vektor_s'] / $sum_vektor_s_syar,
                //         'created_at' => now(),
                //         'updated_at' => now()
                //     ]);
                // }
            }
        }
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
     * @param  \App\Models\IndexSaham  $indexSaham
     * @return \Illuminate\Http\Response
     */
    public function show(IndexSaham $indexSaham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndexSaham  $indexSaham
     * @return \Illuminate\Http\Response
     */
    public function edit(IndexSaham $indexSaham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndexSaham  $indexSaham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndexSaham $indexSaham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndexSaham  $indexSaham
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndexSaham $indexSaham)
    {
        //
    }
}
