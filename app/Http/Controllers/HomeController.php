<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\Sektor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sectors = Sektor::get();
        $emitens = Emiten::get();
        $konvensionals = $emitens->where('index_id', 1);
        $syariahs = $emitens->where('index_id', 2);
        return view('dashboard', compact('sectors', 'emitens', 'konvensionals', 'syariahs'))->with('i');
    }
}
