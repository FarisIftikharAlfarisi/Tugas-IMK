<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    public function loginProcess(Request $request){
        $validator =  Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors('loginfailed');
        }

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if(auth()->attempt($data)){
            if(auth()->user()->role == 'PRODUKSI'){
                return redirect()->route('landing_produksi')->with('login-success','Anda Berhasil login');
            }
            return redirect()->route('landing_admin')->with('login-success','Anda Berhasil Login');
        }else{
            return redirect()->route('login')->with('login-failed','Proses masuk gagal! periksa kembali email dan password');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success','logout successfull');
    }
}
