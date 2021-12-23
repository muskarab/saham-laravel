<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\InstrumentSaham;
use App\Models\User;
use App\Models\VektorS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $instruments = InstrumentSaham::get();
        return view('user.edit', compact('user', 'instruments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'name' => ['required'],
        //     'email' => ['required'],
        //     'address' => ['required'],
        //     'date_of_birth' => ['required'],
        //     'role' => ['required'],
        // ]);
        
        $user = User::findOrFail(Auth::user()->id);

        if ($user->instrument_saham_id == 3) {
            if ($user->id == Auth::user()->id) {
                $user->update([
                    'name' => request('name'),
                    'email' => request('email'),
                    'address' => request('address'),
                    // 'date_of_birth' => Carbon::createFromFormat('m/d/Y', $request['date_of_birth'])->format('Y-m-d'),
                    'gender' => request('gender'),
                    'instrument_saham_id' => request('instrument'),
                    'w_eps_kon' => request('w_eps_kon'),
                    'w_roe_kon' => request('w_roe_kon'),
                    'w_per_kon' => request('w_per_kon'),
                    'w_eps_syar' => request('w_eps_syar'),
                    'w_roe_syar' => request('w_roe_syar'),
                    'w_der_syar' => request('w_der_syar'),
                ]);
            }
        }elseif ($user->instrument_saham_id == 1) {
            if ($user->id == Auth::user()->id) {
                $user->update([
                    'name' => request('name'),
                    'email' => request('email'),
                    'address' => request('address'),
                    // 'date_of_birth' => Carbon::createFromFormat('m/d/Y', $request['date_of_birth'])->format('Y-m-d'),
                    'gender' => request('gender'),
                    'instrument_saham_id' => request('instrument'),
                    'w_eps_kon' => request('w_eps_kon'),
                    'w_roe_kon' => request('w_roe_kon'),
                    'w_per_kon' => request('w_per_kon'),
                ]);
            }
        } elseif ($user->instrument_saham_id == 2) {
            if ($user->id == Auth::user()->id) {
                $user->update([
                    'name' => request('name'),
                    'email' => request('email'),
                    'address' => request('address'),
                    // 'date_of_birth' => Carbon::createFromFormat('m/d/Y', $request['date_of_birth'])->format('Y-m-d'),
                    'gender' => request('gender'),
                    'instrument_saham_id' => request('instrument'),
                    'w_eps_syar' => request('w_eps_syar'),
                    'w_roe_syar' => request('w_roe_syar'),
                    'w_der_syar' => request('w_der_syar'),
                ]);
            }
        }

            // $user = DB::table('users')->where('id', $user->id)->update(['name' => request('name'),
            //     'name' => request('name'),
            //     'email' => request('email'),
            //     'address' => request('address'),
            //     'date_of_birth' => request('date_of_birth'),
            //     'role' => request('role'),
            // ]);
            // $user->update($request->all());
            // dd($request->all());
        return redirect()->route('user.index')->with('success', 'User updated success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted success');
    }
}
