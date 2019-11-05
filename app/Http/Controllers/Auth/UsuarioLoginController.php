<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class UsuarioLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:usuario');
    }

    public function showLoginForm()
    {
        return view ('auth.login');
    }

    public function login(Request $request)
    {   
        $this->validate($request, [
            'nomeu' => 'required',
            'senha' => 'required',
        ]);

        if(Auth::guard('usuario')->attempt(['nomeu' => $request->nomeu, 'senha' => $request->senha], $request->remember))
        {
            dd('aqasdad');
            return redirect()->intended(route('usuario.home'));
        }

        return redirect()->back()->withInput($request->only('nomeu', 'remember'));
    }
}
