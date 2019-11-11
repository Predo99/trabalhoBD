<?php

namespace App\Http\Controllers;

use App\Npc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NpcController extends Controller
{
    public function show(Npc $npc)
    {
        return view('homenpc', compact('npc'));
    }

    public function create(){
        $npc = new Npc();

        return view('/criarnpc',compact('npc'));
    }

    public function converterImagem($input)
    {
        $path = $input->getRealPath();
        $file = file_get_contents($path);
        $bin = base64_encode($file);

        return $bin;
    }

    public function store(){

        if(request()->file('imagem')!=null) {
            $imagem = $this->converterImagem(request()->file('imagem'));
            DB::insert('insert into npc (nomen,senha,tipo,imagem) values (?,?,?,?)',
                [request()->input('nomen'), request()->input('senha'), request()->input('tipo'), $imagem]);
        }else{
            DB::insert('insert into npc (nomen,senha,tipo,imagem) values (?,?,?,?)',
                [request()->input('nomen'), request()->input('senha'), request()->input('tipo'), null]);
        }

        if(request()->file('bd1')!=null) {
            $imagem = $this->converterImagem(request()->file('bd1'));
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo'), 1,$imagem]);
        }else{
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo'), 1,null]);
        }
        if(request()->file('bd2')!=null) {
            $imagem = $this->converterImagem(request()->file('bd2'));
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo').'3', 3,$imagem]);
        }else{
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo').'3', 3,null]);
        }
        if(request()->file('bd3')!=null) {
            $imagem = $this->converterImagem(request()->file('bd3'));
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo').'6', 6,$imagem]);
        }else{
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo').'6', 6,null]);
        }
       return redirect('/');
    }
}
