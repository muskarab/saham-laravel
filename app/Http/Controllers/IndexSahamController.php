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
        $indexs = IndexSaham::get();
        $bobots = Bobot::get();
        return view('index_saham.index', compact('indexs', 'bobots'))->with('i')->with('j');

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
