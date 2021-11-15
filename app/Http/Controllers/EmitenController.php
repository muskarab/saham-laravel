<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\IndexSaham;
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
        $konvensionals = Emiten::where('index_id', '=', 1)->get();
        $syariahs = Emiten::where('index_id', '=', 2)->get();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emiten  $emiten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emiten $emiten)
    {
        //
    }
}
