<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\IndexSaham;
use App\Models\Sektor;
use Illuminate\Http\Request;

class EmitenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konvensionals = Emiten::where('index_id', '=', 1)->orderByRaw('emiten_char ASC')->get();
        $syariahs = Emiten::where('index_id', '=', 2)->orderByRaw('emiten_char ASC')->get();
        $indexs = IndexSaham::get();
        return view('emiten.index', compact('konvensionals', 'syariahs', 'indexs'))->with('i')->with('j');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indexs = IndexSaham::get();
        $sektors = Sektor::get();
        return view('emiten.create', compact('indexs', 'sektors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'emiten_char' => ['required','max:4'],
        //     'perusahaan' => ['required'],
        //     'esp' => ['required'],
        //     'roe' => ['required'],
        //     'per' => ['required'],
        //     'der' => ['required'],
        //     'deskripsi' => ['required'],
        // ]);
        // dd($request->all());
        
        $emiten = Emiten::create([
            'emiten_char' => request('emiten_char'),
            'perusahaan' => request('perusahaan'),
            'index_id' => request('index_id'),
            'sektor_id' => request('sektor_id'),
            'deskripsi' => request('deskripsi'),
            'eps' => request('eps'),
            'roe' => request('roe'),
            'per' => request('per'),
            'der' => request('der'),
        ]);
        if ($emiten) {
            //redirect dengan pesan sukses
            return redirect()->route('emiten.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('emiten.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emiten  $emiten
     * @return \Illuminate\Http\Response
     */
    public function show(Emiten $emiten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emiten  $emiten
     * @return \Illuminate\Http\Response
     */
    public function edit(Emiten $emiten)
    {
        $indexs = IndexSaham::get();
        $sektors = Sektor::get();
        return view('emiten.edit', compact('indexs', 'sektors', 'emiten'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emiten  $emiten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emiten $emiten)
    {
        // $request->validate([
        //     'emiten_char' => ['required','max:4'],
        //     'perusahaan' => ['required'],
        //     'esp' => ['required'],
        //     'roe' => ['required'],
        //     'per' => ['required'],
        //     'der' => ['required'],
        //     'deskripsi' => ['required'],
        // ]);

        $emiten = Emiten::findOrFail($emiten->id);
        $emiten->update([
            'emiten_char' => request('emiten_char'),
            'perusahaan' => request('perusahaan'),
            'index_id' => request('index_id'),
            'sektor_id' => request('sektor_id'),
            'deskripsi' => request('deskripsi'),
            'eps' => request('eps'),
            'roe' => request('roe'),
            'per' => request('per'),
            'der' => request('der'),
        ]);

        if ($emiten) {
            //redirect dengan pesan sukses
            return redirect()->route('emiten.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('emiten.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emiten  $emiten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emiten $emiten)
    {
        $emiten = Emiten::findOrFail($emiten->id);
        $emiten->delete();
        if ($emiten) {
            //redirect dengan pesan sukses
            return redirect()->route('emiten.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('emiten.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
