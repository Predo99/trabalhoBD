<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:usuario');
    // }


    public function show (Usuario $usuario)
    {
        return view ('home', compact('usuario'));
    }

    // public function login ()
    // {
    //     $nome = request()->input('nome');
    //     $senha = request()->input('senha');

    //     $user = DB::select('select * from usuario where nomeu = ?', [$nome]);

    //     if($user)
    //     {
    //         dd($senha);
    //         if ($user[0]->senha == $senha)
    //             dd($user[0]->senha);
    //     }
    //     dd($nome); 
    // }
}
