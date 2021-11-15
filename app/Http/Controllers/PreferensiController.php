<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\Preferensi;
use Illuminate\Http\Request;

class PreferensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preferensis = Preferensi::get();
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
