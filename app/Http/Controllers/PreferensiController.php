<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\Preferensi;
use App\Models\PreferensiKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreferensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $preferensis_kons = Preferensi::where('index_id', '=', 1)->get();
        // $emiten_kons = Emiten::where('index_id', '=', 1)->get();
        // foreach ($emiten_kons as $emiten_kon) {
        //     foreach ($preferensis_kons as $preferensis_kon) {
        //         if ($emiten_kon['eps'] < $preferensis_kon['avg_bawah_eps'] && $emiten_kon['eps'] >= $preferensis_kon['min_eps']) {
        //             echo 1 .'<br>';
        //         }elseif ($emiten_kon['eps'] < $preferensis_kon['mean_eps'] && $emiten_kon['eps'] >= $preferensis_kon['avg_bawah_eps']) {
        //             echo 2 . '<br>';
        //         }elseif ($emiten_kon['eps'] < $preferensis_kon['avg_atas_eps'] && $emiten_kon['eps'] >= $preferensis_kon['mean_eps']) {
        //             echo 3 . '<br>';
        //         }elseif ($emiten_kon['eps'] <= $preferensis_kon['max_eps'] && $emiten_kon['eps'] > $preferensis_kon['avg_atas_eps']) {
        //             echo 4 . '<br>';
        //         }
        //     }
        // }
        
        // DB::table('instrument_sahams')->insert([
        //     'name' => 'Konvensional',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
            // $preferensi_kriteria = PreferensiKriteria::create([
            //     'emiten_char' => request('emiten_char'),
            //     'perusahaan' => request('perusahaan'),
            //     'index_id' => request('index_id'),
            //     'sektor_id' => request('sektor_id'),
            //     'deskripsi' => request('deskripsi'),
            //     'eps' => request('eps'),
            //     'roe' => request('roe'),
            //     'per' => request('per'),
            //     'der' => request('der'),
            // ]);
        $preferensis = Preferensi::get();
        // $lastdata = PreferensiKriteria::orderBy('id', 'DESC')->first();
        // dd($lastdata['id']);
        return view('perhitungan.index', compact('preferensis'));
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
     * @param  \App\Models\Preferensi  $preferensi
     * @return \Illuminate\Http\Response
     */
    public function show(Preferensi $preferensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preferensi  $preferensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Preferensi $preferensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preferensi  $preferensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preferensi $preferensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preferensi  $preferensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preferensi $preferensi)
    {
        //
    }
}
