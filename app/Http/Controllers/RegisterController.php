<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        //dd($request);
        //d($request->get('name'));

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        //validacion
        $this->validate($request,[
            'name' => 'required|max:10',
            'username' => 'required|unique:users|min:5|max:10',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //autenticar usuario
        //auth()->attempt([
        //    'email' => $request->email,
        //    'password' => $request->password,
        //]);

        //autenticar usuario
        auth()->attempt($request->only('email', 'password'));

        //redirrecionar
        return redirect()->route('posts.index');
    }
}
