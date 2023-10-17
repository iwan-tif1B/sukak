<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\master_petugas as petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Auth extends Controller
{
    public function index()
    {
        $data['title'] = "Aplikasi Layanan Rumah Sakit";
        return view('login', $data);
    }

    public function checkauth(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $AuthData = petugas::where('username', $username)->first();
        if (!$AuthData) {
            return redirect('/');
        }
        if (!Hash::check($password, $AuthData->password)) {
            return redirect('/');
        } else {
            Session::put('name', $AuthData->nama_petugas);
            Session::put('user_role', $AuthData->role);
            Session::put('uid', $AuthData->id_petugas);
            Session::put('login', TRUE);
            return redirect()->route('home');
        }
    }

    function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
