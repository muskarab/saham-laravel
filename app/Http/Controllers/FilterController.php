<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\Sektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function sortbyyear($year){
        $sectors = Sektor::get();
        $emitens = Emiten::get();
        $konvensionals = $emitens->where('index_id', 1);
        $syariahs = $emitens->where('index_id', 2);
        $final_kons = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_sahams.instrument_saham_id', 1)
        ->where('tahun', $year)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*', 'vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'index_sahams.tahun as tahun', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->get();
        $final_syar = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_sahams.instrument_saham_id', 2)
        ->where('tahun', $year)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*', 'vektor_s.vektor_s', 'vektor_v_s.vektor_v','index_sahams.name as index', 'index_sahams.tahun as tahun', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->get();
        return view('dashboard.filter', compact('sectors', 'emitens', 'konvensionals', 'syariahs', 'final_kons', 'final_syar'))->with('i')->with('j');
    }

    public function sortbysektor($sektor){
        $sectors = Sektor::get();
        $emitens = Emiten::get();
        $konvensionals = $emitens->where('index_id', 1);
        $syariahs = $emitens->where('index_id', 2);
        $final_kons = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_sahams.instrument_saham_id', 1)
        ->where('sektor_id', $sektor)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*', 'vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'index_sahams.tahun as tahun', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->get();
        $final_syar = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_sahams.instrument_saham_id', 2)
        ->where('sektor_id', $sektor)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*', 'vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'index_sahams.tahun as tahun', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->get();
        return view('dashboard.filter', compact('sectors', 'emitens', 'konvensionals', 'syariahs', 'final_kons', 'final_syar'))->with('i')->with('j');
    }

    public function sortbytop($top){
        $sectors = Sektor::get();
        $emitens = Emiten::get();
        $konvensionals = $emitens->where('index_id', 1);
        $syariahs = $emitens->where('index_id', 2);
        $final_kons = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_sahams.instrument_saham_id', 1)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*', 'vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'index_sahams.tahun as tahun', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->paginate($top);

        $final_syar = DB::table('emitens')
        ->join('vektor_v_s', 'emitens.id', '=', 'vektor_v_s.emiten_id')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->join('index_sahams', 'index_id', '=', 'index_sahams.id')
        ->join('sektors', 'sektor_id', '=', 'sektors.id')
        ->where('index_sahams.instrument_saham_id', 2)
        ->where('vektor_v_s.user_id', Auth::user()->id)
        ->where('vektor_s.user_id', Auth::user()->id)
        ->select('emitens.*', 'vektor_s.vektor_s', 'vektor_v_s.vektor_v', 'index_sahams.name as index', 'index_sahams.tahun as tahun', 'sektors.name as sektor')
        ->orderByRaw('vektor_s DESC')
        ->paginate($top);
        return view('dashboard.filter', compact('sectors', 'emitens', 'konvensionals', 'syariahs', 'final_kons', 'final_syar'))->with('i')->with('j');
    }
}
