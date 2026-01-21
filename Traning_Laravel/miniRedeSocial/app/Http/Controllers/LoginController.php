<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginUserRequest;
use LDAP\Result;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request){
    
        $credentials = $request->validated();    

        if (!Auth::attempt($credentials)){
            return back()->withErrors([
                'username' => "As credenciais estão incorretas",
            ]);
        };

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        

        return redirect()->route("home");

        // return redirect('/');
        //return redirect()->route("home.home");
        // return response()->json(["logout"=>"Foi realizado o Logout"],200);
    }
};
