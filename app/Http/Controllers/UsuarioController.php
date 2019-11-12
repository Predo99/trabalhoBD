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

    public function create(){
        $usuario = new Usuario();

        return view('/criaruser',compact('usuario'));
    }

    public function converterImagem($input)
    {
        $path = $input->getRealPath();
        $file = file_get_contents($path);
        $bin = base64_encode($file);

        return $bin;
    }

    public function store()
    {
        if(request()->file('imagem')!=null) {
            $imagem = $this->converterImagem(request()->file('imagem'));
            DB::insert('insert into usuario (nomeu,gold,nivel,senha, imagem) values (?,?,?,?,?)',
                [request()->input('nomeu'), 0, 1, request()->input('senha'), $imagem]);
        }else{
            DB::insert('insert into usuario (nomeu,gold,nivel,senha, imagem) values (?,?,?,?,?)',
                [request()->input('nomeu'), 0, 1, request()->input('senha'), null]);
        }
        return redirect('/');
    }

    public function edit(Usuario $usuario){

        return view('edituser',compact('usuario'));
    }

    public function update(Usuario $usuario){

        if(request()->file('imagem')!=null) {
            $imagem = $this->converterImagem(request()->file('imagem'));
            DB::table('usuario')
                ->where("usuario.nomeu", '=', $usuario->nomeu)
                ->update(['usuario.gold' => $usuario->gold ,
                          'usuario.nivel' => $usuario->nivel,
                          'usuario.nomeu' => request()->input('nomeu'),
                          'usuario.senha' => request()->input('senha'),
                          'usuario.imagem' => $imagem ]);

        }else{
            DB::table('usuario')
                ->where("usuario.nomeu", '=', $usuario->nomeu)
                ->update(['usuario.gold' => $usuario->gold ,
                    'usuario.nivel' => $usuario->nivel,
                    'usuario.nomeu' => request()->input('nomeu'),
                    'usuario.senha' => request()->input('senha'),
                    'usuario.imagem' => null ]);
        }


        return redirect('/usuarios/'.request()->input('nomeu'));
    }


}
