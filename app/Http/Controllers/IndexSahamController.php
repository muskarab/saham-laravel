<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Emiten;
use App\Models\IndexSaham;
use App\Models\Preferensi;
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
        $indexs = IndexSaham::get();
        $bobots = Bobot::get();
        dd($indexs);
        return view('index_saham.index', compact('indexs', 'bobots'))->with('i')->with('j');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $instruments = InstrumentSaham::get();
        return view('index_saham.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'index_char' => ['required','max:4'],
            'tahun' => ['required'],
        ]);
        // dd($request->all());

        $index_saham = IndexSaham::create([
            'name' => request('index_char'),
            'tahun' => request('tahun'),
            'instrument_saham_id' => request('instrument_id'),
        ]);

        $last_indexs = IndexSaham::orderBy('id', 'DESC')->first();
        Preferensi::create([
            'index_id' => $last_indexs->id,
            'min_eps' => 0,
            'max_eps' => 0,
            'mean_eps' => 0,
            'avg_bawah_eps' => 0,
            'avg_atas_eps' => 0,
            'min_roe' => 0,
            'max_roe' => 0,
            'mean_roe' => 0,
            'avg_bawah_roe' => 0,
            'avg_atas_roe' => 0,
            'min_per' => 0,
            'max_per' => 0,
            'mean_per' => 0,
            'avg_bawah_per' => 0,
            'avg_atas_per' => 0,
            'min_der' => 0,
            'max_der' => 0,
            'mean_der' => 0,
            'avg_bawah_der' => 0,
            'avg_atas_der' => 0,
        ]);
        if ($index_saham) {
            //redirect dengan pesan sukses
            return redirect()->route('index_saham.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('index_saham.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
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
        // dd($indexSaham);
        return view('index_saham.edit', compact('indexSaham'));
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
        $indexSaham = IndexSaham::findOrFail($indexSaham->id);
        $indexSaham->update([
            'name' => request('index_char'),
            'tahun' => request('tahun'),
            'instrument_saham_id' => request('instrument_id'),
        ]);

        if ($indexSaham) {
            //redirect dengan pesan sukses
            return redirect()->route('index_saham.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('index_saham.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndexSaham  $indexSaham
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndexSaham $indexSaham)
    {
        $indexSaham = IndexSaham::findOrFail($indexSaham->id);
        $indexSaham->delete();
        DB::table('preferensis')->where('index_id', $indexSaham->id)->delete();
        $emitens = Emiten::where('index_id', $indexSaham->id)->get();
        foreach ($emitens as $emiten) {
            DB::table('vektor_s')->where('emiten_id', $emiten->id)->delete();
            DB::table('vektor_v_s')->where('emiten_id', $emiten->id)->delete();
        }
        DB::table('emitens')->where('index_id', $indexSaham->id)->delete();

        if ($indexSaham) {
            //redirect dengan pesan sukses
            return redirect()->route('index_saham.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('index_saham.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
