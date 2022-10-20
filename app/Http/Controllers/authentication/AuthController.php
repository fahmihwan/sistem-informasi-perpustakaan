<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use App\Models\Credential;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function index()
    {
        $items =  Petugas::with(['credential'])->latest()->get();


        return view('pages.account.index', [
            'items' =>  $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated =  $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'telp' => 'required|numeric',
            'hak_akses' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);


        if ($request->password != $request->confirm_password) {
            return redirect('/account/create')->withErrors('password harus sama');
        }


        try {
            DB::beginTransaction();

            $credential_id = Credential::create([
                'nama' => $validated['nama'],
                'telp' => $validated['telp'],
            ])->id;

            Petugas::create([
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'hak_akses' => $validated['hak_akses'],
                'credential_id' => $credential_id,
            ]);

            DB::commit();
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }

        return redirect('/account');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
