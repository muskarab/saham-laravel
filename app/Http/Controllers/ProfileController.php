<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\InstrumentSaham;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $sim_kon = array();
        $user_logins = User::where('id', Auth::user()->id)->get();
        $not_user_logins = User::where('role', '!=', 'admin')->where('id', '!=', Auth::user()->id)->get();
        foreach ($user_logins as $user_login) {
            foreach ($not_user_logins as $not_user_login) {
                $sim_kon[] = ["name" => $not_user_login->name, "sim" => (($user_login->w_eps_kon * $not_user_login->w_eps_kon) + ($user_login->w_roe_kon * $not_user_login->w_roe_kon) + ($user_login->w_per_kon * $not_user_login->w_per_kon)) / (sqrt(pow($user_login->w_eps_kon, 2) + pow($user_login->w_roe_kon, 2) + pow($user_login->w_per_kon, 2)) * sqrt(pow($not_user_login->w_eps_kon, 2) + pow($not_user_login->w_roe_kon, 2) + pow($not_user_login->w_per_kon, 2)))];
            }
        }
        // dd($sim_kon, $user_logins, $not_user_logins);
        // $count_sim_kon = count($sim_kon);
        // for ($i=0; $i < $count_sim_kon ; $i++) {
        //     if ($sim_kon[$i]['sim'] > $sim_kon[1]['sim']) {
        //         print_r($sim_kon[$i]['name']);
        //     }
        // }
        // $max = max(array_map(function ($sim_kon) {
        //     return $sim_kon['sim'];
        // },
        //     $sim_kon
        // ));
        $max_sim = $sim_kon[array_search(max($prices = array_column($sim_kon, 'sim')), $prices)];
        $get_user_sim = User::where('name', $max_sim['name'])->get();
        // dd($sim_kon, $get_user_sim);
        $instruments = InstrumentSaham::get();
        return view('profile.edit', compact('instruments', 'get_user_sim'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('You are not allowed to change the password for a default user.')]);
        }

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
