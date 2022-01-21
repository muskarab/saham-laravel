<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\IndexSaham;
use App\Models\Preferensi;
use App\Models\PreferensiKriteria;
use App\Models\Sektor;
use App\Models\User;
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

        PreferensiKriteria::create([
            'emiten_id' => 0,
            'eps_pk' => 0,
            'roe_pk' => 0,
            'per_pk' => 0,
            'der_pk' => 0,
        ]);

        $users = User::get();

        $lastdata_emiten = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->select('emitens.*', 'index_sahams.instrument_saham_id')
        ->orderBy('id', 'DESC')
        ->first();
        foreach ($users as $user) {
            // if ($lastdata_emiten->instrument_saham_id == 1) {
            //     if ($user->instrument_saham_id == 1) {
                    VektorS::where('user_id', $user->id)->create([
                        'emiten_id' => $lastdata_emiten->id,
                        'vektor_s' => 0,
                        'user_id' => $user->id,
                    ]);
                    VektorV::where('user_id', $user->id)->create([
                        'emiten_id' => $lastdata_emiten->id,
                        'vektor_v' => 0,
                        'user_id' => $user->id,
                    ]);
            //     }
            //     elseif ($user->instrument_saham_id == 3) {
            //         VektorS::where('user_id', $user->id)->create([
            //             'emiten_id' => $lastdata_emiten->id,
            //             'vektor_s' => 0,
            //             'user_id' => $user->id,
            //         ]);
            //         VektorV::where('user_id', $user->id)->create([
            //             'emiten_id' => $lastdata_emiten->id,
            //             'vektor_v' => 0,
            //             'user_id' => $user->id,
            //         ]);
            //     }
            // }
            // if ($lastdata_emiten->instrument_saham_id == 2) {
            //     if ($user->instrument_saham_id == 2) {
            //         VektorS::where('user_id', $user->id)->create([
            //             'emiten_id' => $lastdata_emiten->id,
            //             'vektor_s' => 0,
            //             'user_id' => $user->id,
            //         ]);
            //         VektorV::where('user_id', $user->id)->create([
            //             'emiten_id' => $lastdata_emiten->id,
            //             'vektor_v' => 0,
            //             'user_id' => $user->id,
            //         ]);
            //     }
            //     elseif ($user->instrument_saham_id == 3) {
            //         VektorS::where('user_id', $user->id)->create([
            //             'emiten_id' => $lastdata_emiten->id,
            //             'vektor_s' => 0,
            //             'user_id' => $user->id,
            //         ]);
            //         VektorV::where('user_id', $user->id)->create([
            //             'emiten_id' => $lastdata_emiten->id,
            //             'vektor_v' => 0,
            //             'user_id' => $user->id,
            //         ]);
            //     }
            // }
        }

        //Update preferensi
        $indexs = IndexSaham::get();
        foreach ($indexs as $index) {
            $min_eps = Emiten::where('index_id', '=', $index->id)->min('eps');
            $min_roe = Emiten::where('index_id', '=', $index->id)->min('roe');
            $min_per = Emiten::where('index_id', '=', $index->id)->min('per');
            $min_der = Emiten::where('index_id', '=', $index->id)->min('der');
            $max_eps = Emiten::where('index_id', '=', $index->id)->max('eps');
            $max_roe = Emiten::where('index_id', '=', $index->id)->max('roe');
            $max_per = Emiten::where('index_id', '=', $index->id)->max('per');
            $max_der = Emiten::where('index_id', '=', $index->id)->max('der');
            $mean_eps = Emiten::where('index_id', '=', $index->id)->avg('eps');
            $mean_roe = Emiten::where('index_id', '=', $index->id)->avg('roe');
            $mean_per = Emiten::where('index_id', '=', $index->id)->avg('per');
            $mean_der = Emiten::where('index_id', '=', $index->id)->avg('der');
            $avg_bawah_eps = ($min_eps + $mean_eps) / 2;
            $avg_bawah_roe = ($min_roe + $mean_roe) / 2;
            $avg_bawah_per = ($min_per + $mean_per) / 2;
            $avg_bawah_der = ($min_der + $mean_der) / 2;
            $avg_atas_eps = ($mean_eps + $max_eps) / 2;
            $avg_atas_roe = ($mean_roe + $max_roe) / 2;
            $avg_atas_per = ($mean_per + $max_per) / 2;
            $avg_atas_der = ($mean_der + $max_der) / 2;
            DB::table('preferensis')->where('index_id', $index->id)->update([
                'index_id' => $index->id,
                'min_eps' => $min_eps,
                'max_eps' => $max_eps,
                'mean_eps' => $mean_eps,
                'avg_bawah_eps' => $avg_bawah_eps,
                'avg_atas_eps' => $avg_atas_eps,
                'min_roe' => $min_roe,
                'max_roe' => $max_roe,
                'mean_roe' => $mean_roe,
                'avg_bawah_roe' => $avg_bawah_roe,
                'avg_atas_roe' => $avg_atas_roe,
                'min_per' => $min_per,
                'max_per' => $max_per,
                'mean_per' => $mean_per,
                'avg_bawah_per' => $avg_bawah_per,
                'avg_atas_per' => $avg_atas_per,
                'min_der' => $min_der,
                'max_der' => $max_der,
                'mean_der' => $mean_der,
                'avg_bawah_der' => $avg_bawah_der,
                'avg_atas_der' => $avg_atas_der,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        //Ubah data terakhir menjadi sesuai foreign_key
        $lastdata = PreferensiKriteria::orderBy('id', 'DESC')->first();
        $update = DB::table('preferensi_kriterias')->where('id', $lastdata['id'])->update([
            'emiten_id' => $lastdata['id'],
        ]);

        //Update data Preferensi Saham terakhir sesuai perhitungan
        $indexs = IndexSaham::get();
        foreach ($indexs as $index) {
            $preferensis = Preferensi::where('index_id', '=', $index->id)->get();
            $emitens = Emiten::where('index_id', '=', $index->id)->get();
            foreach ($emitens as $emiten) {
                foreach ($preferensis as $preferensi) {
                    if ($emiten['eps'] < $preferensi['avg_bawah_eps'] && $emiten['eps'] >= $preferensi['min_eps']) {
                        $eps_pk = 1;
                    } elseif ($emiten['eps'] < $preferensi['mean_eps'] && $emiten['eps'] >= $preferensi['avg_bawah_eps']) {
                        $eps_pk = 2;
                    } elseif ($emiten['eps'] < $preferensi['avg_atas_eps'] && $emiten['eps'] >= $preferensi['mean_eps']) {
                        $eps_pk = 3;
                    } elseif ($emiten['eps'] <= $preferensi['max_eps'] && $emiten['eps'] > $preferensi['avg_atas_eps']
                    ) {
                        $eps_pk = 4;
                    }

                    if ($emiten['roe'] < $preferensi['avg_bawah_roe'] && $emiten['roe'] >= $preferensi['min_roe']) {
                        $roe_pk = 1;
                    } elseif ($emiten['roe'] < $preferensi['mean_roe'] && $emiten['roe'] >= $preferensi['avg_bawah_roe']) {
                        $roe_pk = 2;
                    } elseif ($emiten['roe'] < $preferensi['avg_atas_roe'] && $emiten['roe'] >= $preferensi['mean_roe']) {
                        $roe_pk = 3;
                    } elseif ($emiten['roe'] <= $preferensi['max_roe'] && $emiten['roe'] > $preferensi['avg_atas_roe']
                    ) {
                        $roe_pk = 4;
                    }

                    if ($emiten['per'] < $preferensi['avg_bawah_per'] && $emiten['per'] >= $preferensi['min_per']) {
                        $per_pk = 1;
                    } elseif ($emiten['per'] < $preferensi['mean_per'] && $emiten['per'] >= $preferensi['avg_bawah_per']) {
                        $per_pk = 2;
                    } elseif ($emiten['per'] < $preferensi['avg_atas_per'] && $emiten['per'] >= $preferensi['mean_per']) {
                        $per_pk = 3;
                    } elseif ($emiten['per'] <= $preferensi['max_per'] && $emiten['per'] > $preferensi['avg_atas_per']
                    ) {
                        $per_pk = 4;
                    }

                    if ($emiten['der'] < $preferensi['avg_bawah_der'] && $emiten['der'] >= $preferensi['min_der']) {
                        $der_pk = 1;
                    } elseif ($emiten['der'] < $preferensi['mean_der'] && $emiten['der'] >= $preferensi['avg_bawah_der']) {
                        $der_pk = 2;
                    } elseif ($emiten['der'] < $preferensi['avg_atas_der'] && $emiten['der'] >= $preferensi['mean_der']) {
                        $der_pk = 3;
                    } elseif ($emiten['der'] <= $preferensi['max_der'] && $emiten['der'] > $preferensi['avg_atas_der']
                    ) {
                        $der_pk = 4;
                    }
                    DB::table('preferensi_kriterias')->where('emiten_id', $emiten->id)->update([
                        'emiten_id' => $emiten->id,
                        'eps_pk' => $eps_pk,
                        'roe_pk' => $roe_pk,
                        'per_pk' => $per_pk,
                        'der_pk' => $der_pk,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        //Update vektor s dan vektor v
        $users = User::get();
        $index_kons = IndexSaham::where('instrument_saham_id', 1)->get();
        $index_syars = IndexSaham::where('instrument_saham_id', 2)->get();
        $emiten_kons = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 1)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        $emiten_syars = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 2)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        foreach ($users as $user) {
            //update vektor s Konvensional
            foreach ($emiten_kons as $emiten_kon) {
                $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                $w_total = $w_eps * $w_roe * $w_per;
                DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_kon->id)->update([
                    'vektor_s' => $w_total,
                    'updated_at' => now()
                ]);
            }
            //update vektor v
            foreach ($index_kons as $index_kon) {
                $sum_vektor_s_kon = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                ->where('index_sahams.id', $index_kon->id)
                ->where('vektor_s.user_id', $user->id)
                ->select('vektor_s.vektor_s')
                    ->sum('vektor_s.vektor_s');
                $vektor_s_kons = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                ->where('index_sahams.id', $index_kon->id)
                ->where('vektor_s.user_id', $user->id)
                ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                ->get();
                foreach ($vektor_s_kons as $vektor_s_kon) {
                    DB::table('vektor_v_s')
                    ->where('user_id', $user->id)
                    ->where('emiten_id', $vektor_s_kon->id)
                    ->update([
                        'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                        'updated_at' => now()
                    ]);
                }
            }

            //update vektor s Syariah
            foreach ($emiten_syars as $emiten_syar) {
                $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
                $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                $w_total = $w_eps * $w_roe * $w_der;
                DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_syar->id)->update([
                    'vektor_s' => $w_total,
                    'updated_at' => now()
                ]);
            }
            //update vektor v
            foreach ($index_syars as $index_syar) {
                $sum_vektor_s_kon = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                ->where('index_sahams.id', $index_syar->id)
                ->where('vektor_s.user_id', $user->id)
                ->select('vektor_s.vektor_s')
                    ->sum('vektor_s.vektor_s');
                $vektor_s_kons = DB::table('emitens')
                ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                ->where('index_sahams.id', $index_syar->id)
                ->where('vektor_s.user_id', $user->id)
                ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                ->get();
                foreach ($vektor_s_kons as $vektor_s_kon) {
                    DB::table('vektor_v_s')
                    ->where('user_id', $user->id)
                    ->where('emiten_id', $vektor_s_kon->id)
                    ->update([
                        'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                        'updated_at' => now()
                    ]);
                }
            }
        }

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

        //Update preferensi
        $indexs = IndexSaham::get();
        foreach ($indexs as $index) {
            $min_eps = Emiten::where('index_id', '=', $index->id)->min('eps');
            $min_roe = Emiten::where('index_id', '=', $index->id)->min('roe');
            $min_per = Emiten::where('index_id', '=', $index->id)->min('per');
            $min_der = Emiten::where('index_id', '=', $index->id)->min('der');
            $max_eps = Emiten::where('index_id', '=', $index->id)->max('eps');
            $max_roe = Emiten::where('index_id', '=', $index->id)->max('roe');
            $max_per = Emiten::where('index_id', '=', $index->id)->max('per');
            $max_der = Emiten::where('index_id', '=', $index->id)->max('der');
            $mean_eps = Emiten::where('index_id', '=', $index->id)->avg('eps');
            $mean_roe = Emiten::where('index_id', '=', $index->id)->avg('roe');
            $mean_per = Emiten::where('index_id', '=', $index->id)->avg('per');
            $mean_der = Emiten::where('index_id', '=', $index->id)->avg('der');
            $avg_bawah_eps = ($min_eps + $mean_eps) / 2;
            $avg_bawah_roe = ($min_roe + $mean_roe) / 2;
            $avg_bawah_per = ($min_per + $mean_per) / 2;
            $avg_bawah_der = ($min_der + $mean_der) / 2;
            $avg_atas_eps = ($mean_eps + $max_eps) / 2;
            $avg_atas_roe = ($mean_roe + $max_roe) / 2;
            $avg_atas_per = ($mean_per + $max_per) / 2;
            $avg_atas_der = ($mean_der + $max_der) / 2;
            DB::table('preferensis')->where('index_id', $index->id)->update([
                'index_id' => $index->id,
                'min_eps' => $min_eps,
                'max_eps' => $max_eps,
                'mean_eps' => $mean_eps,
                'avg_bawah_eps' => $avg_bawah_eps,
                'avg_atas_eps' => $avg_atas_eps,
                'min_roe' => $min_roe,
                'max_roe' => $max_roe,
                'mean_roe' => $mean_roe,
                'avg_bawah_roe' => $avg_bawah_roe,
                'avg_atas_roe' => $avg_atas_roe,
                'min_per' => $min_per,
                'max_per' => $max_per,
                'mean_per' => $mean_per,
                'avg_bawah_per' => $avg_bawah_per,
                'avg_atas_per' => $avg_atas_per,
                'min_der' => $min_der,
                'max_der' => $max_der,
                'mean_der' => $mean_der,
                'avg_bawah_der' => $avg_bawah_der,
                'avg_atas_der' => $avg_atas_der,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        //Update data terakhir sesuai perhitungan
        $indexs = IndexSaham::get();
        foreach ($indexs as $index) {
            $preferensis = Preferensi::where('index_id', '=', $index->id)->get();
            $emitens = Emiten::where('index_id', '=', $index->id)->get();
            foreach ($emitens as $emiten) {
                foreach ($preferensis as $preferensi) {
                    if ($emiten['eps'] < $preferensi['avg_bawah_eps'] && $emiten['eps'] >= $preferensi['min_eps']) {
                        $eps_pk = 1;
                    } elseif ($emiten['eps'] < $preferensi['mean_eps'] && $emiten['eps'] >= $preferensi['avg_bawah_eps']) {
                        $eps_pk = 2;
                    } elseif ($emiten['eps'] < $preferensi['avg_atas_eps'] && $emiten['eps'] >= $preferensi['mean_eps']) {
                        $eps_pk = 3;
                    } elseif (
                        $emiten['eps'] <= $preferensi['max_eps'] && $emiten['eps'] > $preferensi['avg_atas_eps']
                    ) {
                        $eps_pk = 4;
                    }

                    if ($emiten['roe'] < $preferensi['avg_bawah_roe'] && $emiten['roe'] >= $preferensi['min_roe']) {
                        $roe_pk = 1;
                    } elseif ($emiten['roe'] < $preferensi['mean_roe'] && $emiten['roe'] >= $preferensi['avg_bawah_roe']) {
                        $roe_pk = 2;
                    } elseif ($emiten['roe'] < $preferensi['avg_atas_roe'] && $emiten['roe'] >= $preferensi['mean_roe']) {
                        $roe_pk = 3;
                    } elseif (
                        $emiten['roe'] <= $preferensi['max_roe'] && $emiten['roe'] > $preferensi['avg_atas_roe']
                    ) {
                        $roe_pk = 4;
                    }

                    if ($emiten['per'] < $preferensi['avg_bawah_per'] && $emiten['per'] >= $preferensi['min_per']) {
                        $per_pk = 1;
                    } elseif ($emiten['per'] < $preferensi['mean_per'] && $emiten['per'] >= $preferensi['avg_bawah_per']) {
                        $per_pk = 2;
                    } elseif ($emiten['per'] < $preferensi['avg_atas_per'] && $emiten['per'] >= $preferensi['mean_per']) {
                        $per_pk = 3;
                    } elseif (
                        $emiten['per'] <= $preferensi['max_per'] && $emiten['per'] > $preferensi['avg_atas_per']
                    ) {
                        $per_pk = 4;
                    }

                    if ($emiten['der'] < $preferensi['avg_bawah_der'] && $emiten['der'] >= $preferensi['min_der']) {
                        $der_pk = 1;
                    } elseif ($emiten['der'] < $preferensi['mean_der'] && $emiten['der'] >= $preferensi['avg_bawah_der']) {
                        $der_pk = 2;
                    } elseif ($emiten['der'] < $preferensi['avg_atas_der'] && $emiten['der'] >= $preferensi['mean_der']) {
                        $der_pk = 3;
                    } elseif (
                        $emiten['der'] <= $preferensi['max_der'] && $emiten['der'] > $preferensi['avg_atas_der']
                    ) {
                        $der_pk = 4;
                    }
                    DB::table('preferensi_kriterias')->where('emiten_id', $emiten->id)->update([
                        'emiten_id' => $emiten->id,
                        'eps_pk' => $eps_pk,
                        'roe_pk' => $roe_pk,
                        'per_pk' => $per_pk,
                        'der_pk' => $der_pk,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        //Update vektor s dan vektor v
        $users = User::get();
        $index_kons = IndexSaham::where('instrument_saham_id', 1)->get();
        $index_syars = IndexSaham::where('instrument_saham_id', 2)->get();
        $emiten_kons = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 1)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        $emiten_syars = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 2)
            ->select('emitens.*', 'index_sahams.name')
            ->get();
        foreach ($users as $user) {
            if ($user->instrument_saham_id == 1) {
                //update vektor s
                foreach ($emiten_kons as $emiten_kon) {
                    $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                    $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                    $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                    $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_per;
                    DB::table('vektor_s')
                    ->where('user_id', $user->id)
                    ->where('emiten_id', $emiten_kon->id)
                    ->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                foreach ($index_kons as $index_kon) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                        ->where('index_sahams.id', $index_kon->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('vektor_s.vektor_s')
                        ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_kon->id)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                    ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                            ->where('emiten_id', $vektor_s_kon->id)
                            ->update([
                                'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                                'updated_at' => now()
                            ]);
                    }
                }
            }
            if ($user->instrument_saham_id == 2) {
                //update vektor s
                foreach ($emiten_syars as $emiten_syar) {
                    $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
                    $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                    $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                    $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_der;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_syar->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                foreach ($index_syars as $index_syar) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                        ->where('index_sahams.id', $index_syar->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('vektor_s.vektor_s')
                        ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_syar->id)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('emitens.*', 'vektor_s.user_id',
                        'vektor_s.vektor_s'
                    )
                    ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                            ->where('emiten_id', $vektor_s_kon->id)
                            ->update([
                                'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                                'updated_at' => now()
                            ]);
                    }
                }
            }
            if ($user->instrument_saham_id == 3) {
                //update vektor s
                foreach ($emiten_kons as $emiten_kon) {
                    $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                    $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                    $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                    $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_per;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_kon->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                foreach ($index_kons as $index_kon) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                        ->where('index_sahams.id', $index_kon->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('vektor_s.vektor_s')
                        ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_kon->id)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                    ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                            ->where('emiten_id', $vektor_s_kon->id)
                            ->update([
                                'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                                'updated_at' => now()
                            ]);
                    }
                }
                //update vektor s
                foreach ($emiten_syars as $emiten_syar) {
                    $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
                    $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                    $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                    $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_der;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_syar->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                foreach ($index_syars as $index_syar) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                        ->where('index_sahams.id', $index_syar->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('vektor_s.vektor_s')
                        ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_syar->id)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('emitens.*', 'vektor_s.user_id',
                        'vektor_s.vektor_s'
                    )
                    ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                            ->where('emiten_id', $vektor_s_kon->id)
                            ->update([
                                'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                                'updated_at' => now()
                            ]);
                    }
                }
            }
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
        DB::table('preferensi_kriterias')->where('emiten_id', $emiten->id)->delete();
        DB::table('vektor_s')->where('emiten_id', $emiten->id)->delete();
        DB::table('vektor_v_s')->where('emiten_id', $emiten->id)->delete();

        //Update preferensi
        $indexs = IndexSaham::get();
        foreach ($indexs as $index) {
            $min_eps = Emiten::where('index_id', '=', $index->id)->min('eps');
            $min_roe = Emiten::where('index_id', '=', $index->id)->min('roe');
            $min_per = Emiten::where('index_id', '=', $index->id)->min('per');
            $min_der = Emiten::where('index_id', '=', $index->id)->min('der');
            $max_eps = Emiten::where('index_id', '=', $index->id)->max('eps');
            $max_roe = Emiten::where('index_id', '=', $index->id)->max('roe');
            $max_per = Emiten::where('index_id', '=', $index->id)->max('per');
            $max_der = Emiten::where('index_id', '=', $index->id)->max('der');
            $mean_eps = Emiten::where('index_id', '=', $index->id)->avg('eps');
            $mean_roe = Emiten::where('index_id', '=', $index->id)->avg('roe');
            $mean_per = Emiten::where('index_id', '=', $index->id)->avg('per');
            $mean_der = Emiten::where('index_id', '=', $index->id)->avg('der');
            $avg_bawah_eps = ($min_eps + $mean_eps) / 2;
            $avg_bawah_roe = ($min_roe + $mean_roe) / 2;
            $avg_bawah_per = ($min_per + $mean_per) / 2;
            $avg_bawah_der = ($min_der + $mean_der) / 2;
            $avg_atas_eps = ($mean_eps + $max_eps) / 2;
            $avg_atas_roe = ($mean_roe + $max_roe) / 2;
            $avg_atas_per = ($mean_per + $max_per) / 2;
            $avg_atas_der = ($mean_der + $max_der) / 2;
            DB::table('preferensis')->where('index_id', $index->id)->update([
                'index_id' => $index->id,
                'min_eps' => $min_eps,
                'max_eps' => $max_eps,
                'mean_eps' => $mean_eps,
                'avg_bawah_eps' => $avg_bawah_eps,
                'avg_atas_eps' => $avg_atas_eps,
                'min_roe' => $min_roe,
                'max_roe' => $max_roe,
                'mean_roe' => $mean_roe,
                'avg_bawah_roe' => $avg_bawah_roe,
                'avg_atas_roe' => $avg_atas_roe,
                'min_per' => $min_per,
                'max_per' => $max_per,
                'mean_per' => $mean_per,
                'avg_bawah_per' => $avg_bawah_per,
                'avg_atas_per' => $avg_atas_per,
                'min_der' => $min_der,
                'max_der' => $max_der,
                'mean_der' => $mean_der,
                'avg_bawah_der' => $avg_bawah_der,
                'avg_atas_der' => $avg_atas_der,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        //Update data terakhir sesuai perhitungan
        $indexs = IndexSaham::get();
        foreach ($indexs as $index) {
            $preferensis = Preferensi::where('index_id', '=', $index->id)->get();
            $emitens = Emiten::where('index_id', '=', $index->id)->get();
            foreach ($emitens as $emiten) {
                foreach ($preferensis as $preferensi) {
                    if ($emiten['eps'] < $preferensi['avg_bawah_eps'] && $emiten['eps'] >= $preferensi['min_eps']) {
                        $eps_pk = 1;
                    } elseif ($emiten['eps'] < $preferensi['mean_eps'] && $emiten['eps'] >= $preferensi['avg_bawah_eps']) {
                        $eps_pk = 2;
                    } elseif ($emiten['eps'] < $preferensi['avg_atas_eps'] && $emiten['eps'] >= $preferensi['mean_eps']) {
                        $eps_pk = 3;
                    } elseif (
                        $emiten['eps'] <= $preferensi['max_eps'] && $emiten['eps'] > $preferensi['avg_atas_eps']
                    ) {
                        $eps_pk = 4;
                    }

                    if ($emiten['roe'] < $preferensi['avg_bawah_roe'] && $emiten['roe'] >= $preferensi['min_roe']) {
                        $roe_pk = 1;
                    } elseif ($emiten['roe'] < $preferensi['mean_roe'] && $emiten['roe'] >= $preferensi['avg_bawah_roe']) {
                        $roe_pk = 2;
                    } elseif ($emiten['roe'] < $preferensi['avg_atas_roe'] && $emiten['roe'] >= $preferensi['mean_roe']) {
                        $roe_pk = 3;
                    } elseif (
                        $emiten['roe'] <= $preferensi['max_roe'] && $emiten['roe'] > $preferensi['avg_atas_roe']
                    ) {
                        $roe_pk = 4;
                    }

                    if ($emiten['per'] < $preferensi['avg_bawah_per'] && $emiten['per'] >= $preferensi['min_per']) {
                        $per_pk = 1;
                    } elseif ($emiten['per'] < $preferensi['mean_per'] && $emiten['per'] >= $preferensi['avg_bawah_per']) {
                        $per_pk = 2;
                    } elseif ($emiten['per'] < $preferensi['avg_atas_per'] && $emiten['per'] >= $preferensi['mean_per']) {
                        $per_pk = 3;
                    } elseif (
                        $emiten['per'] <= $preferensi['max_per'] && $emiten['per'] > $preferensi['avg_atas_per']
                    ) {
                        $per_pk = 4;
                    }

                    if ($emiten['der'] < $preferensi['avg_bawah_der'] && $emiten['der'] >= $preferensi['min_der']) {
                        $der_pk = 1;
                    } elseif ($emiten['der'] < $preferensi['mean_der'] && $emiten['der'] >= $preferensi['avg_bawah_der']) {
                        $der_pk = 2;
                    } elseif ($emiten['der'] < $preferensi['avg_atas_der'] && $emiten['der'] >= $preferensi['mean_der']) {
                        $der_pk = 3;
                    } elseif (
                        $emiten['der'] <= $preferensi['max_der'] && $emiten['der'] > $preferensi['avg_atas_der']
                    ) {
                        $der_pk = 4;
                    }
                    DB::table('preferensi_kriterias')->where('emiten_id', $emiten->id)->update([
                        'emiten_id' => $emiten->id,
                        'eps_pk' => $eps_pk,
                        'roe_pk' => $roe_pk,
                        'per_pk' => $per_pk,
                        'der_pk' => $der_pk,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        //Update vektor s dan vektor v
        $users = User::get();
        $index_kons = IndexSaham::where('instrument_saham_id', 1)->get();
        $index_syars = IndexSaham::where('instrument_saham_id', 2)->get();
        $emiten_kons = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 1)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        $emiten_syars = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 2)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        foreach ($users as $user) {
            if ($user->instrument_saham_id == 1) {
                //update vektor s
                foreach ($emiten_kons as $emiten_kon) {
                    $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                    $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                    $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                    $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_per;
                    DB::table('vektor_s')
                    ->where('user_id', $user->id)
                        ->where('emiten_id', $emiten_kon->id)
                        ->update([
                            'vektor_s' => $w_total,
                            'updated_at' => now()
                        ]);
                }
                //update vektor v
                foreach ($index_kons as $index_kon) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_kon->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('vektor_s.vektor_s')
                        ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_kon->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                        ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                            ->where('emiten_id', $vektor_s_kon->id)
                            ->update([
                                'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                                'updated_at' => now()
                            ]);
                    }
                }
            }
            if ($user->instrument_saham_id == 2) {
                //update vektor s
                foreach ($emiten_syars as $emiten_syar) {
                    $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
                    $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                    $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                    $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_der;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_syar->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                foreach ($index_syars as $index_syar) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_syar->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('vektor_s.vektor_s')
                        ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_syar->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select(
                            'emitens.*',
                            'vektor_s.user_id',
                            'vektor_s.vektor_s'
                        )
                        ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                            ->where('emiten_id', $vektor_s_kon->id)
                            ->update([
                                'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                                'updated_at' => now()
                            ]);
                    }
                }
            }
            if ($user->instrument_saham_id == 3) {
                //update vektor s
                foreach ($emiten_kons as $emiten_kon) {
                    $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                    $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                    $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                    $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_per;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_kon->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                foreach ($index_kons as $index_kon) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_kon->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('vektor_s.vektor_s')
                        ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_kon->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                        ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                            ->where('emiten_id', $vektor_s_kon->id)
                            ->update([
                                'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                                'updated_at' => now()
                            ]);
                    }
                }
                //update vektor s
                foreach ($emiten_syars as $emiten_syar) {
                    $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
                    $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                    $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                    $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_der;
                    DB::table('vektor_s')->where('user_id', $user->id)->where('emiten_id', $emiten_syar->id)->update([
                        'vektor_s' => $w_total,
                        'updated_at' => now()
                    ]);
                }
                //update vektor v
                foreach ($index_syars as $index_syar) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_syar->id)
                        ->where('vektor_s.user_id', $user->id)
                        ->select('vektor_s.vektor_s')
                        ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index_syar->id)
                    ->where('vektor_s.user_id', $user->id)
                    ->select(
                        'emitens.*',
                        'vektor_s.user_id',
                        'vektor_s.vektor_s'
                    )
                    ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')
                        ->where('user_id', $user->id)
                        ->where('emiten_id', $vektor_s_kon->id)
                        ->update([
                            'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                            'updated_at' => now()
                        ]);
                    }
                }
            }
        }

        if ($emiten) {
            //redirect dengan pesan sukses
            return redirect()->route('emiten.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('emiten.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
