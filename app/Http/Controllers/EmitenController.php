<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Emiten;
use App\Models\IndexSaham;
use App\Models\Preferensi;
use App\Models\PreferensiKriteria;
use App\Models\Sektor;
use App\Models\VektorS;
use App\Models\VektorV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $preferensi_kriteria = PreferensiKriteria::create([
            'emiten_id' => 0,
            'eps_pk' => 0,
            'roe_pk' => 0,
            'per_pk' => 0,
            'der_pk' => 0,
        ]);

        // $vekto_s = VektorS::create([
        //     'emiten_id' => 0,
        //     'vektor_s' => 0,
        // ]);

        // $vekto_s = VektorV::create([
        //     'emiten_id' => 0,
        //     'vektor_v' => 0,
        // ]);

        $min_eps_kon = Emiten::where('index_id', '=', 1)->min('eps');
        $min_roe_kon = Emiten::where('index_id', '=', 1)->min('roe');
        $min_per_kon = Emiten::where('index_id', '=', 1)->min('per');
        $min_der_kon = Emiten::where('index_id', '=', 1)->min('der');
        $max_eps_kon = Emiten::where('index_id', '=', 1)->max('eps');
        $max_roe_kon = Emiten::where('index_id', '=', 1)->max('roe');
        $max_per_kon = Emiten::where('index_id', '=', 1)->max('per');
        $max_der_kon = Emiten::where('index_id', '=', 1)->max('der');
        $mean_eps_kon = Emiten::where('index_id', '=', 1)->avg('eps');
        $mean_roe_kon = Emiten::where('index_id', '=', 1)->avg('roe');
        $mean_per_kon = Emiten::where('index_id', '=', 1)->avg('per');
        $mean_der_kon = Emiten::where('index_id', '=', 1)->avg('der');
        $avg_bawah_eps_kon = ($min_eps_kon + $mean_eps_kon) / 2;
        $avg_bawah_roe_kon = ($min_roe_kon + $mean_roe_kon) / 2;
        $avg_bawah_per_kon = ($min_per_kon + $mean_per_kon) / 2;
        $avg_bawah_der_kon = ($min_der_kon + $mean_der_kon) / 2;
        $avg_atas_eps_kon = ($mean_eps_kon + $max_eps_kon) / 2;
        $avg_atas_roe_kon = ($mean_roe_kon + $max_roe_kon) / 2;
        $avg_atas_per_kon = ($mean_per_kon + $max_per_kon) / 2;
        $avg_atas_der_kon = ($mean_der_kon + $max_der_kon) / 2;
        $min_eps_sya = Emiten::where('index_id', '=', 2)->min('eps');
        $min_roe_sya = Emiten::where('index_id', '=', 2)->min('roe');
        $min_per_sya = Emiten::where('index_id', '=', 2)->min('per');
        $min_der_sya = Emiten::where('index_id', '=', 2)->min('der');
        $max_eps_sya = Emiten::where('index_id', '=', 2)->max('eps');
        $max_roe_sya = Emiten::where('index_id', '=', 2)->max('roe');
        $max_per_sya = Emiten::where('index_id', '=', 2)->max('per');
        $max_der_sya = Emiten::where('index_id', '=', 2)->max('der');
        $mean_eps_sya = Emiten::where('index_id', '=', 2)->avg('eps');
        $mean_roe_sya = Emiten::where('index_id', '=', 2)->avg('roe');
        $mean_per_sya = Emiten::where('index_id', '=', 2)->avg('per');
        $mean_der_sya = Emiten::where('index_id', '=', 2)->avg('der');
        $avg_bawah_eps_sya = ($min_eps_sya + $mean_eps_sya) / 2;
        $avg_bawah_roe_sya = ($min_roe_sya + $mean_roe_sya) / 2;
        $avg_bawah_per_sya = ($min_per_sya + $mean_per_sya) / 2;
        $avg_bawah_der_sya = ($min_der_sya + $mean_der_sya) / 2;
        $avg_atas_eps_sya = ($mean_eps_sya + $max_eps_sya) / 2;
        $avg_atas_roe_sya = ($mean_roe_sya + $max_roe_sya) / 2;
        $avg_atas_per_sya = ($mean_per_sya + $max_per_sya) / 2;
        $avg_atas_der_sya = ($mean_der_sya + $max_der_sya) / 2;

        $konfensional = DB::table('preferensis')->where('id', 1)->update([
            'min_eps' => $min_eps_kon,
            'max_eps' => $max_eps_kon,
            'mean_eps' => $mean_eps_kon,
            'avg_bawah_eps' => $avg_bawah_eps_kon,
            'avg_atas_eps' => $avg_atas_eps_kon,
            'min_roe' => $min_roe_kon,
            'max_roe' => $max_roe_kon,
            'mean_roe' => $mean_roe_kon,
            'avg_bawah_roe' => $avg_bawah_roe_kon,
            'avg_atas_roe' => $avg_atas_roe_kon,
            'min_per' => $min_per_kon,
            'max_per' => $max_per_kon,
            'mean_per' => $mean_per_kon,
            'avg_bawah_per' => $avg_bawah_per_kon,
            'avg_atas_per' => $avg_atas_per_kon,
            'min_der' => $min_der_kon,
            'max_der' => $max_der_kon,
            'mean_der' => $mean_der_kon,
            'avg_bawah_der' => $avg_bawah_der_kon,
            'avg_atas_der' => $avg_atas_der_kon,
        ]);
        $syariah = DB::table('preferensis')->where('id', 2)->update([
            'min_eps' => $min_eps_sya,
            'max_eps' => $max_eps_sya,
            'mean_eps' => $mean_eps_sya,
            'avg_bawah_eps' => $avg_bawah_eps_sya,
            'avg_atas_eps' => $avg_atas_eps_sya,
            'min_roe' => $min_roe_sya,
            'max_roe' => $max_roe_sya,
            'mean_roe' => $mean_roe_sya,
            'avg_bawah_roe' => $avg_bawah_roe_sya,
            'avg_atas_roe' => $avg_atas_roe_sya,
            'min_per' => $min_per_sya,
            'max_per' => $max_per_sya,
            'mean_per' => $mean_per_sya,
            'avg_bawah_per' => $avg_bawah_per_sya,
            'avg_atas_per' => $avg_atas_per_sya,
            'min_der' => $min_der_sya,
            'max_der' => $max_der_sya,
            'mean_der' => $mean_der_sya,
            'avg_bawah_der' => $avg_bawah_der_sya,
            'avg_atas_der' => $avg_atas_der_sya,
        ]);

        //Ubah data terakhir menjadi sesuai foreign_key
        $lastdata = PreferensiKriteria::orderBy('id', 'DESC')->first();
        $update = DB::table('preferensi_kriterias')->where('id', $lastdata['id'])->update([
            'emiten_id' => $lastdata['id'],
        ]);

        //Update data terakhir sesuai perhitungan
        $preferensis_kons = Preferensi::where('index_id', '=', 1)->get();
        $emiten_kons = Emiten::where('index_id', '=', 1)->get();
        foreach ($emiten_kons as $emiten_kon) {
            foreach ($preferensis_kons as $preferensis_kon) {
                if ($emiten_kon['eps'] < $preferensis_kon['avg_bawah_eps'] && $emiten_kon['eps'] >= $preferensis_kon['min_eps']) {
                    $eps_pk_kon = 1;
                } elseif ($emiten_kon['eps'] < $preferensis_kon['mean_eps'] && $emiten_kon['eps'] >= $preferensis_kon['avg_bawah_eps']) {
                    $eps_pk_kon = 2;
                } elseif ($emiten_kon['eps'] < $preferensis_kon['avg_atas_eps'] && $emiten_kon['eps'] >= $preferensis_kon['mean_eps']) {
                    $eps_pk_kon = 3;
                } elseif ($emiten_kon['eps'] <= $preferensis_kon['max_eps'] && $emiten_kon['eps'] > $preferensis_kon['avg_atas_eps']) {
                    $eps_pk_kon = 4;
                }

                if ($emiten_kon['roe'] < $preferensis_kon['avg_bawah_roe'] && $emiten_kon['roe'] >= $preferensis_kon['min_roe']) {
                    $roe_pk_kon = 1;
                } elseif ($emiten_kon['roe'] < $preferensis_kon['mean_roe'] && $emiten_kon['roe'] >= $preferensis_kon['avg_bawah_roe']) {
                    $roe_pk_kon = 2;
                } elseif ($emiten_kon['roe'] < $preferensis_kon['avg_atas_roe'] && $emiten_kon['roe'] >= $preferensis_kon['mean_roe']) {
                    $roe_pk_kon = 3;
                } elseif ($emiten_kon['roe'] <= $preferensis_kon['max_roe'] && $emiten_kon['roe'] > $preferensis_kon['avg_atas_roe']) {
                    $roe_pk_kon = 4;
                }

                if ($emiten_kon['per'] < $preferensis_kon['avg_bawah_per'] && $emiten_kon['per'] >= $preferensis_kon['min_per']) {
                    $per_pk_kon = 1;
                } elseif ($emiten_kon['per'] < $preferensis_kon['mean_per'] && $emiten_kon['per'] >= $preferensis_kon['avg_bawah_per']) {
                    $per_pk_kon = 2;
                } elseif ($emiten_kon['per'] < $preferensis_kon['avg_atas_per'] && $emiten_kon['per'] >= $preferensis_kon['mean_per']) {
                    $per_pk_kon = 3;
                } elseif ($emiten_kon['per'] <= $preferensis_kon['max_per'] && $emiten_kon['per'] > $preferensis_kon['avg_atas_per']) {
                    $per_pk_kon = 4;
                }

                if ($emiten_kon['der'] < $preferensis_kon['avg_bawah_der'] && $emiten_kon['der'] >= $preferensis_kon['min_der']) {
                    $der_pk_kon = 1;
                } elseif ($emiten_kon['der'] < $preferensis_kon['mean_der'] && $emiten_kon['der'] >= $preferensis_kon['avg_bawah_der']) {
                    $der_pk_kon = 2;
                } elseif ($emiten_kon['der'] < $preferensis_kon['avg_atas_der'] && $emiten_kon['der'] >= $preferensis_kon['mean_der']) {
                    $der_pk_kon = 3;
                } elseif ($emiten_kon['der'] <= $preferensis_kon['max_der'] && $emiten_kon['der'] > $preferensis_kon['avg_atas_der']) {
                    $der_pk_kon = 4;
                }

                $update = DB::table('preferensi_kriterias')->where('emiten_id', $emiten_kon->id)->update([
                    'emiten_id' => $emiten_kon->id,
                    'eps_pk' => $eps_pk_kon,
                    'roe_pk' => $roe_pk_kon,
                    'per_pk' => $per_pk_kon,
                    'der_pk' => $der_pk_kon,
                ]);
            }
        }

        $preferensis_syars = Preferensi::where('index_id', '=', 2)->get();
        $emiten_syars = Emiten::where('index_id', '=', 2)->get();
        foreach ($emiten_syars as $emiten_syar) {
            foreach ($preferensis_syars as $preferensis_syar) {
                if ($emiten_syar['eps'] < $preferensis_syar['avg_bawah_eps'] && $emiten_syar['eps'] >= $preferensis_syar['min_eps']) {
                    $eps_pk_syar = 1;
                } elseif ($emiten_syar['eps'] < $preferensis_syar['mean_eps'] && $emiten_syar['eps'] >= $preferensis_syar['avg_bawah_eps']) {
                    $eps_pk_syar = 2;
                } elseif ($emiten_syar['eps'] < $preferensis_syar['avg_atas_eps'] && $emiten_syar['eps'] >= $preferensis_syar['mean_eps']) {
                    $eps_pk_syar = 3;
                } elseif ($emiten_syar['eps'] <= $preferensis_syar['max_eps'] && $emiten_syar['eps'] > $preferensis_syar['avg_atas_eps']) {
                    $eps_pk_syar = 4;
                }

                if ($emiten_syar['roe'] < $preferensis_syar['avg_bawah_roe'] && $emiten_syar['roe'] >= $preferensis_syar['min_roe']) {
                    $roe_pk_syar = 1;
                } elseif ($emiten_syar['roe'] < $preferensis_syar['mean_roe'] && $emiten_syar['roe'] >= $preferensis_syar['avg_bawah_roe']) {
                    $roe_pk_syar = 2;
                } elseif ($emiten_syar['roe'] < $preferensis_syar['avg_atas_roe'] && $emiten_syar['roe'] >= $preferensis_syar['mean_roe']) {
                    $roe_pk_syar = 3;
                } elseif ($emiten_syar['roe'] <= $preferensis_syar['max_roe'] && $emiten_syar['roe'] > $preferensis_syar['avg_atas_roe']) {
                    $roe_pk_syar = 4;
                }

                if ($emiten_syar['per'] < $preferensis_syar['avg_bawah_per'] && $emiten_syar['per'] >= $preferensis_syar['min_per']) {
                    $per_pk_syar = 1;
                } elseif ($emiten_syar['per'] < $preferensis_syar['mean_per'] && $emiten_syar['per'] >= $preferensis_syar['avg_bawah_per']) {
                    $per_pk_syar = 2;
                } elseif ($emiten_syar['per'] < $preferensis_syar['avg_atas_per'] && $emiten_syar['per'] >= $preferensis_syar['mean_per']) {
                    $per_pk_syar = 3;
                } elseif ($emiten_syar['per'] <= $preferensis_syar['max_per'] && $emiten_syar['per'] > $preferensis_syar['avg_atas_per']) {
                    $per_pk_syar = 4;
                }

                if ($emiten_syar['der'] < $preferensis_syar['avg_bawah_der'] && $emiten_syar['der'] >= $preferensis_syar['min_der']) {
                    $der_pk_syar = 1;
                } elseif ($emiten_syar['der'] < $preferensis_syar['mean_der'] && $emiten_syar['der'] >= $preferensis_syar['avg_bawah_der']) {
                    $der_pk_syar = 2;
                } elseif ($emiten_syar['der'] < $preferensis_syar['avg_atas_der'] && $emiten_syar['der'] >= $preferensis_syar['mean_der']) {
                    $der_pk_syar = 3;
                } elseif ($emiten_syar['der'] <= $preferensis_syar['max_der'] && $emiten_syar['der'] > $preferensis_syar['avg_atas_der']) {
                    $der_pk_syar = 4;
                }

                $update = DB::table('preferensi_kriterias')->where('emiten_id', $emiten_syar->id)->update([
                    'emiten_id' => $emiten_syar->id,
                    'eps_pk' => $eps_pk_syar,
                    'roe_pk' => $roe_pk_syar,
                    'per_pk' => $per_pk_syar,
                    'der_pk' => $der_pk_syar,
                ]);
            }
        }

        //Ubah data terakhir menjadi sesuai foreign_key
        $lastdata_vektor_s = VektorS::orderBy('id', 'DESC')->first();
        $update = DB::table('vektor_s')->where('id', $lastdata_vektor_s['id'])->update([
            'emiten_id' => $lastdata_vektor_s['id'],
        ]);

        // Update data terakhir sesuai perhitungan
        $emiten_kons = Emiten::where('index_id', 1)->get();
        $bobots = Bobot::where('instrument_saham_id', '=', 1)->get();
        foreach ($emiten_kons as $emiten_kon) {
            foreach ($bobots as $bobot) {
                $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], -$bobot['w_eps']);
                $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], $bobot['w_roe']);
                $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], $bobot['w_per']);
                $w_total_kon = $w_eps * $w_roe * $w_per;
                $update = DB::table('vektor_s')->where('emiten_id', $emiten_kon->id)->update([
                        'emiten_id' => $emiten_kon->id,
                        'vektor_s' => $w_total_kon,
                    ]);
            }
        }

        $emiten_syars = Emiten::where('index_id', 2)->get();
        $bobots = Bobot::where('instrument_saham_id', '=', 2)->get();
        foreach ($emiten_syars as $emiten_syar) {
            foreach ($bobots as $bobot) {
                $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], $bobot['w_eps']);
                $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], $bobot['w_roe']);
                $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], $bobot['w_der']);
                $w_total_syar = $w_eps * $w_roe * $w_der;
                $update = DB::table('vektor_s')->where('emiten_id', $emiten_syar->id)->update([
                        'emiten_id' => $emiten_syar->id,
                        'vektor_s' => $w_total_syar,
                    ]);
            }
        }

        //Ubah data terakhir menjadi sesuai foreign_key
        $lastdata_vektor_v = VektorV::orderBy('id', 'DESC')->first();
        $update = DB::table('vektor_v_s')->where('id', $lastdata_vektor_v['id'])->update([
            'emiten_id' => $lastdata_vektor_s['id'],
        ]);

        // Update data terakhir sesuai perhitungan
        // $sum_vektor_s_kon = DB::table('emitens')
        //     ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        //     ->where('index_id', 1)
        //     ->select('vektor_s.vektor_s')
        //     ->sum('vektor_s.vektor_s');
        // // echo $sum_vektor_s_kon;
        // $emiten_kons = Emiten::where('index_id', 1)->get();
        // foreach ($emiten_kons as $emiten_kon) {
        //     $update = DB::table('vektor_v_s')->where('emiten_id', $emiten_kon->id)->update([
        //         'emiten_id' => $emiten_kon->id,
        //         'vektor_v' =>$emiten_kon->vektor_s['vektor_s'] / $sum_vektor_s_kon,
        //     ]);
        //     // DB::table('vektor_v_s')->insert([
        //     //     'emiten_id' => $emiten_kon->id,
        //     //     'vektor_v' => $emiten_kon->vektor_s['vektor_s'] / $sum_vektor_s_kon,
        //     // ]);
        // }

        // $sum_vektor_s_syar = DB::table('emitens')
        // ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        // ->where('index_id', 2)
        // ->select('vektor_s.vektor_s')
        // ->sum('vektor_s.vektor_s');
        // // echo $sum_vektor_s_syar;
        // $emiten_syars = Emiten::where('index_id', 2)->get();
        // foreach ($emiten_syars as $emiten_syar) {
        //     $update = DB::table('vektor_v_s')->where('emiten_id', $emiten_syar->id)->update([
        //         'emiten_id' => $emiten_syar->id,
        //         'vektor_v' => $emiten_syar->vektor_s['vektor_s'] / $sum_vektor_s_syar,
        //     ]);
        //     // DB::table('vektor_v_s')->insert([
        //     //     'emiten_id' => $emiten_syar->id,
        //     //     'vektor_v' => $emiten_syar->vektor_s['vektor_s'] / $sum_vektor_s_syar,
        //     // ]);
        // }

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

        $min_eps_kon = Emiten::where('index_id', '=', 1)->min('eps');
        $min_roe_kon = Emiten::where('index_id', '=', 1)->min('roe');
        $min_per_kon = Emiten::where('index_id', '=', 1)->min('per');
        $min_der_kon = Emiten::where('index_id', '=', 1)->min('der');
        $max_eps_kon = Emiten::where('index_id', '=', 1)->max('eps');
        $max_roe_kon = Emiten::where('index_id', '=', 1)->max('roe');
        $max_per_kon = Emiten::where('index_id', '=', 1)->max('per');
        $max_der_kon = Emiten::where('index_id', '=', 1)->max('der');
        $mean_eps_kon = Emiten::where('index_id', '=', 1)->avg('eps');
        $mean_roe_kon = Emiten::where('index_id', '=', 1)->avg('roe');
        $mean_per_kon = Emiten::where('index_id', '=', 1)->avg('per');
        $mean_der_kon = Emiten::where('index_id', '=', 1)->avg('der');
        $avg_bawah_eps_kon = ($min_eps_kon + $mean_eps_kon) / 2;
        $avg_bawah_roe_kon = ($min_roe_kon + $mean_roe_kon) / 2;
        $avg_bawah_per_kon = ($min_per_kon + $mean_per_kon) / 2;
        $avg_bawah_der_kon = ($min_der_kon + $mean_der_kon) / 2;
        $avg_atas_eps_kon = ($mean_eps_kon + $max_eps_kon) / 2;
        $avg_atas_roe_kon = ($mean_roe_kon + $max_roe_kon) / 2;
        $avg_atas_per_kon = ($mean_per_kon + $max_per_kon) / 2;
        $avg_atas_der_kon = ($mean_der_kon + $max_der_kon) / 2;
        $min_eps_sya = Emiten::where('index_id', '=', 2)->min('eps');
        $min_roe_sya = Emiten::where('index_id', '=', 2)->min('roe');
        $min_per_sya = Emiten::where('index_id', '=', 2)->min('per');
        $min_der_sya = Emiten::where('index_id', '=', 2)->min('der');
        $max_eps_sya = Emiten::where('index_id', '=', 2)->max('eps');
        $max_roe_sya = Emiten::where('index_id', '=', 2)->max('roe');
        $max_per_sya = Emiten::where('index_id', '=', 2)->max('per');
        $max_der_sya = Emiten::where('index_id', '=', 2)->max('der');
        $mean_eps_sya = Emiten::where('index_id', '=', 2)->avg('eps');
        $mean_roe_sya = Emiten::where('index_id', '=', 2)->avg('roe');
        $mean_per_sya = Emiten::where('index_id', '=', 2)->avg('per');
        $mean_der_sya = Emiten::where('index_id', '=', 2)->avg('der');
        $avg_bawah_eps_sya = ($min_eps_sya + $mean_eps_sya) / 2;
        $avg_bawah_roe_sya = ($min_roe_sya + $mean_roe_sya) / 2;
        $avg_bawah_per_sya = ($min_per_sya + $mean_per_sya) / 2;
        $avg_bawah_der_sya = ($min_der_sya + $mean_der_sya) / 2;
        $avg_atas_eps_sya = ($mean_eps_sya + $max_eps_sya) / 2;
        $avg_atas_roe_sya = ($mean_roe_sya + $max_roe_sya) / 2;
        $avg_atas_per_sya = ($mean_per_sya + $max_per_sya) / 2;
        $avg_atas_der_sya = ($mean_der_sya + $max_der_sya) / 2;
        
        $konfensional = DB::table('preferensis')->where('id', 1)->update([
            'min_eps' => $min_eps_kon,
            'max_eps' => $max_eps_kon,
            'mean_eps' => $mean_eps_kon,
            'avg_bawah_eps' => $avg_bawah_eps_kon,
            'avg_atas_eps' => $avg_atas_eps_kon,
            'min_roe' => $min_roe_kon,
            'max_roe' => $max_roe_kon,
            'mean_roe' => $mean_roe_kon,
            'avg_bawah_roe' => $avg_bawah_roe_kon,
            'avg_atas_roe' => $avg_atas_roe_kon,
            'min_per' => $min_per_kon,
            'max_per' => $max_per_kon,
            'mean_per' => $mean_per_kon,
            'avg_bawah_per' => $avg_bawah_per_kon,
            'avg_atas_per' => $avg_atas_per_kon,
            'min_der' => $min_der_kon,
            'max_der' => $max_der_kon,
            'mean_der' => $mean_der_kon,
            'avg_bawah_der' => $avg_bawah_der_kon,
            'avg_atas_der' => $avg_atas_der_kon,
        ]);
        $syariah = DB::table('preferensis')->where('id', 2)->update([
            'min_eps' => $min_eps_sya,
            'max_eps' => $max_eps_sya,
            'mean_eps' => $mean_eps_sya,
            'avg_bawah_eps' => $avg_bawah_eps_sya,
            'avg_atas_eps' => $avg_atas_eps_sya,
            'min_roe' => $min_roe_sya,
            'max_roe' => $max_roe_sya,
            'mean_roe' => $mean_roe_sya,
            'avg_bawah_roe' => $avg_bawah_roe_sya,
            'avg_atas_roe' => $avg_atas_roe_sya,
            'min_per' => $min_per_sya,
            'max_per' => $max_per_sya,
            'mean_per' => $mean_per_sya,
            'avg_bawah_per' => $avg_bawah_per_sya,
            'avg_atas_per' => $avg_atas_per_sya,
            'min_der' => $min_der_sya,
            'max_der' => $max_der_sya,
            'mean_der' => $mean_der_sya,
            'avg_bawah_der' => $avg_bawah_der_sya,
            'avg_atas_der' => $avg_atas_der_sya,
        ]);

        //Update data sesuai perhitungan
        $preferensis_kons = Preferensi::where('index_id', '=', 1)->get();
        $emiten_kons = Emiten::where('index_id', '=', 1)->get();
        foreach ($emiten_kons as $emiten_kon) {
            foreach ($preferensis_kons as $preferensis_kon) {
                if ($emiten_kon['eps'] < $preferensis_kon['avg_bawah_eps'] && $emiten_kon['eps'] >= $preferensis_kon['min_eps']) {
                    $eps_pk_kon = 1;
                } elseif ($emiten_kon['eps'] < $preferensis_kon['mean_eps'] && $emiten_kon['eps'] >= $preferensis_kon['avg_bawah_eps']) {
                    $eps_pk_kon = 2;
                } elseif ($emiten_kon['eps'] < $preferensis_kon['avg_atas_eps'] && $emiten_kon['eps'] >= $preferensis_kon['mean_eps']) {
                    $eps_pk_kon = 3;
                } elseif ($emiten_kon['eps'] <= $preferensis_kon['max_eps'] && $emiten_kon['eps'] > $preferensis_kon['avg_atas_eps']) {
                    $eps_pk_kon = 4;
                }

                if ($emiten_kon['roe'] < $preferensis_kon['avg_bawah_roe'] && $emiten_kon['roe'] >= $preferensis_kon['min_roe']) {
                    $roe_pk_kon = 1;
                } elseif ($emiten_kon['roe'] < $preferensis_kon['mean_roe'] && $emiten_kon['roe'] >= $preferensis_kon['avg_bawah_roe']) {
                    $roe_pk_kon = 2;
                } elseif ($emiten_kon['roe'] < $preferensis_kon['avg_atas_roe'] && $emiten_kon['roe'] >= $preferensis_kon['mean_roe']) {
                    $roe_pk_kon = 3;
                } elseif ($emiten_kon['roe'] <= $preferensis_kon['max_roe'] && $emiten_kon['roe'] > $preferensis_kon['avg_atas_roe']) {
                    $roe_pk_kon = 4;
                }

                if ($emiten_kon['per'] < $preferensis_kon['avg_bawah_per'] && $emiten_kon['per'] >= $preferensis_kon['min_per']) {
                    $per_pk_kon = 1;
                } elseif ($emiten_kon['per'] < $preferensis_kon['mean_per'] && $emiten_kon['per'] >= $preferensis_kon['avg_bawah_per']) {
                    $per_pk_kon = 2;
                } elseif ($emiten_kon['per'] < $preferensis_kon['avg_atas_per'] && $emiten_kon['per'] >= $preferensis_kon['mean_per']) {
                    $per_pk_kon = 3;
                } elseif ($emiten_kon['per'] <= $preferensis_kon['max_per'] && $emiten_kon['per'] > $preferensis_kon['avg_atas_per']) {
                    $per_pk_kon = 4;
                }

                if ($emiten_kon['der'] < $preferensis_kon['avg_bawah_der'] && $emiten_kon['der'] >= $preferensis_kon['min_der']) {
                    $der_pk_kon = 1;
                } elseif ($emiten_kon['der'] < $preferensis_kon['mean_der'] && $emiten_kon['der'] >= $preferensis_kon['avg_bawah_der']) {
                    $der_pk_kon = 2;
                } elseif ($emiten_kon['der'] < $preferensis_kon['avg_atas_der'] && $emiten_kon['der'] >= $preferensis_kon['mean_der']) {
                    $der_pk_kon = 3;
                } elseif ($emiten_kon['der'] <= $preferensis_kon['max_der'] && $emiten_kon['der'] > $preferensis_kon['avg_atas_der']) {
                    $der_pk_kon = 4;
                }

                $update = DB::table('preferensi_kriterias')->where('emiten_id', $emiten_kon->id)->update([
                    'emiten_id' => $emiten_kon->id,
                    'eps_pk' => $eps_pk_kon,
                    'roe_pk' => $roe_pk_kon,
                    'per_pk' => $per_pk_kon,
                    'der_pk' => $der_pk_kon,
                ]);
            }
        }

        $preferensis_syars = Preferensi::where('index_id', '=', 2)->get();
        $emiten_syars = Emiten::where('index_id', '=', 2)->get();
        foreach ($emiten_syars as $emiten_syar) {
            foreach ($preferensis_syars as $preferensis_syar) {
                if ($emiten_syar['eps'] < $preferensis_syar['avg_bawah_eps'] && $emiten_syar['eps'] >= $preferensis_syar['min_eps']) {
                    $eps_pk_syar = 1;
                } elseif ($emiten_syar['eps'] < $preferensis_syar['mean_eps'] && $emiten_syar['eps'] >= $preferensis_syar['avg_bawah_eps']) {
                    $eps_pk_syar = 2;
                } elseif ($emiten_syar['eps'] < $preferensis_syar['avg_atas_eps'] && $emiten_syar['eps'] >= $preferensis_syar['mean_eps']) {
                    $eps_pk_syar = 3;
                } elseif ($emiten_syar['eps'] <= $preferensis_syar['max_eps'] && $emiten_syar['eps'] > $preferensis_syar['avg_atas_eps']) {
                    $eps_pk_syar = 4;
                }

                if ($emiten_syar['roe'] < $preferensis_syar['avg_bawah_roe'] && $emiten_syar['roe'] >= $preferensis_syar['min_roe']) {
                    $roe_pk_syar = 1;
                } elseif ($emiten_syar['roe'] < $preferensis_syar['mean_roe'] && $emiten_syar['roe'] >= $preferensis_syar['avg_bawah_roe']) {
                    $roe_pk_syar = 2;
                } elseif ($emiten_syar['roe'] < $preferensis_syar['avg_atas_roe'] && $emiten_syar['roe'] >= $preferensis_syar['mean_roe']) {
                    $roe_pk_syar = 3;
                } elseif ($emiten_syar['roe'] <= $preferensis_syar['max_roe'] && $emiten_syar['roe'] > $preferensis_syar['avg_atas_roe']) {
                    $roe_pk_syar = 4;
                }

                if ($emiten_syar['per'] < $preferensis_syar['avg_bawah_per'] && $emiten_syar['per'] >= $preferensis_syar['min_per']) {
                    $per_pk_syar = 1;
                } elseif ($emiten_syar['per'] < $preferensis_syar['mean_per'] && $emiten_syar['per'] >= $preferensis_syar['avg_bawah_per']) {
                    $per_pk_syar = 2;
                } elseif ($emiten_syar['per'] < $preferensis_syar['avg_atas_per'] && $emiten_syar['per'] >= $preferensis_syar['mean_per']) {
                    $per_pk_syar = 3;
                } elseif ($emiten_syar['per'] <= $preferensis_syar['max_per'] && $emiten_syar['per'] > $preferensis_syar['avg_atas_per']) {
                    $per_pk_syar = 4;
                }

                if ($emiten_syar['der'] < $preferensis_syar['avg_bawah_der'] && $emiten_syar['der'] >= $preferensis_syar['min_der']) {
                    $der_pk_syar = 1;
                } elseif ($emiten_syar['der'] < $preferensis_syar['mean_der'] && $emiten_syar['der'] >= $preferensis_syar['avg_bawah_der']) {
                    $der_pk_syar = 2;
                } elseif ($emiten_syar['der'] < $preferensis_syar['avg_atas_der'] && $emiten_syar['der'] >= $preferensis_syar['mean_der']) {
                    $der_pk_syar = 3;
                } elseif ($emiten_syar['der'] <= $preferensis_syar['max_der'] && $emiten_syar['der'] > $preferensis_syar['avg_atas_der']) {
                    $der_pk_syar = 4;
                }

                $update = DB::table('preferensi_kriterias')->where('emiten_id', $emiten_syar->id)->update([
                    'emiten_id' => $emiten_syar->id,
                    'eps_pk' => $eps_pk_syar,
                    'roe_pk' => $roe_pk_syar,
                    'per_pk' => $per_pk_syar,
                    'der_pk' => $der_pk_syar,
                ]);
            }
        }

        // Update data sesuai perhitungan
        $emiten_kons = Emiten::where('index_id', 1)->get();
        $bobots = Bobot::where('instrument_saham_id', '=', 1)->get();
        foreach ($emiten_kons as $emiten_kon) {
            foreach ($bobots as $bobot) {
                $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], -$bobot['w_eps']);
                $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], $bobot['w_roe']);
                $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], $bobot['w_per']);
                $w_total_kon = $w_eps * $w_roe * $w_per;
                $update = DB::table('vektor_s')->where(
                    'emiten_id',
                    $emiten_kon->id
                )->update([
                    'emiten_id' => $emiten_kon->id,
                    'vektor_s' => $w_total_kon,
                ]);
            }
        }

        $emiten_syars = Emiten::where('index_id', 2)->get();
        $bobots = Bobot::where('instrument_saham_id', '=', 2)->get();
        foreach ($emiten_syars as $emiten_syar) {
            foreach ($bobots as $bobot) {
                $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], $bobot['w_eps']);
                $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], $bobot['w_roe']);
                $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], $bobot['w_der']);
                $w_total_syar = $w_eps * $w_roe * $w_der;
                $update = DB::table('vektor_s')->where('emiten_id', $emiten_kon->id)->update([
                        'emiten_id' => $emiten_kon->id,
                        'vektor_s' => $w_total_syar,
                    ]);
            }
        }

        // Update data terakhir sesuai perhitungan
        $sum_vektor_s_kon = DB::table('emitens')
            ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
            ->where('index_id', 1)
            ->select('vektor_s.vektor_s')
            ->sum('vektor_s.vektor_s');
        // echo $sum_vektor_s_kon;
        $emiten_kons = Emiten::where('index_id', 1)->get();
        foreach ($emiten_kons as $emiten_kon) {
            $update = DB::table('vektor_v_s')->where('emiten_id', $emiten_kon->id)->update([
                    'emiten_id' => $emiten_kon->id,
                    'vektor_v' => $emiten_kon->vektor_s['vektor_s'] / $sum_vektor_s_kon,
                ]);
            // DB::table('vektor_v_s')->insert([
            //     'emiten_id' => $emiten_kon->id,
            //     'vektor_v' => $emiten_kon->vektor_s['vektor_s'] / $sum_vektor_s_kon,
            // ]);
        }

        $sum_vektor_s_syar = DB::table('emitens')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
            ->where('index_id', 2)
            ->select('vektor_s.vektor_s')
            ->sum('vektor_s.vektor_s');
        // echo $sum_vektor_s_syar;
        $emiten_syars = Emiten::where('index_id', 2)->get();
        foreach ($emiten_syars as $emiten_syar) {
            $update = DB::table('vektor_v_s')->where('emiten_id', $emiten_syar->id)->update([
                'emiten_id' => $emiten_syar->id,
                'vektor_v' => $emiten_syar->vektor_s['vektor_s'] / $sum_vektor_s_syar,
            ]);
            // DB::table('vektor_v_s')->insert([
            //     'emiten_id' => $emiten_syar->id,
            //     'vektor_v' => $emiten_syar->vektor_s['vektor_s'] / $sum_vektor_s_syar,
            // ]);
        }

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
