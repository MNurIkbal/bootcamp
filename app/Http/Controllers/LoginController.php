<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' =>  'Login Aplikasi Penilaian Mahasiswa'
        ];

        return view('login', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function masuk(Request $request)
    {
        $request->validate([
            'username'  =>  'required|max:255|string|min:5',
            'password'  =>  'required|min:6|max:12'
        ], [
            'username.required' =>  'Username Harus Diisi',
            'username.max'  =>  'Username Terlalu Panjang',
            'username.string'   =>  'Username Tidak Valid',
            'username.min'  =>  'Username Terlalu Pendek',

            'password.required' =>  'Password Harus Diisi',
            'password.min'  =>  'Password Terlalu Pendek',
            'password.max'  =>  'Password Terlalu Panjang'
        ]);

        $username = $request->username;
        $password = $request->password;

        $check_username = User::where('username', $username)->first();
        if ($check_username) {
            if (password_verify($password, $check_username->password)) {
                session([
                    'login' =>  true,
                    'id'    => $check_username->id,
                    'username'  =>  $check_username->username,
                    'name'  =>  $check_username->name
                ]);

                return redirect()->to('dashboard');
            } else {
                return redirect()->to('/')->with('error', 'Username Atau Password Salah');
            }
        } else {
            return redirect()->to('/')->with('error', 'Username Atau Password Salah');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dashboard()
    {
        $login = session('login');
        
        $data = [
            'title' =>  'Dashboard Aplikasi Penilaian Mahasiswa'
        ];
        return view('dashboard', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
