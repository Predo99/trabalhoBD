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
                [request()->input('nomen'), request()->input('senha'), request()->input('tipo'), url(asset('images/npcdefault.jpg'))]);
        }

        if(request()->file('bd1')!=null) {
            $imagem = $this->converterImagem(request()->file('bd1'));
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo'), 1,$imagem]);
        }else{
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo'), 1,url(asset('images/bdf1.jpg'))]);
        }
        if(request()->file('bd2')!=null) {
            $imagem = $this->converterImagem(request()->file('bd2'));
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo').'3', 3,$imagem]);
        }else{
            DB::insert('insert into badge (nomeb,nivel,imagem) values (?,?,?)',
                [request()->input('tipo').'3', 3,url(asset('images/bdf2.jpg'))]);
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

    public function edit(Npc $npc){
        return view('editnpc',compact('npc'));
    }

    public function update(Npc $npc){
        if(request()->file('imagem')!=null) {
            $imagem = $this->converterImagem(request()->file('imagem'));
            DB::table('npc')
                ->where("npc.tipo", '=', $npc->tipo)
                ->update([
                    'npc.tipo' => request()->input('tipo'),
                    'npc.nomen' => request()->input('nomen'),
                    'npc.senha' => request()->input('senha'),
                    'usuario.imagem' => $imagem ]);
        }else{
            DB::table('npc')
                ->where("npc.tipo", '=', $npc->tipo)
                ->update([
                    'npc.tipo' => request()->input('tipo'),
                    'npc.nomen' => request()->input('nomen'),
                    'npc.senha' => request()->input('senha'),
                    'usuario.imagem' => null ]);
        }

        if(request()->file('bd1')!=null) {
            $imagem = $this->converterImagem(request()->file('bd1'));
            DB::table('badge')
                ->where("nomeb",'=',$npc->tipo)
                ->update([
                    'badge.nomeb' => request()->input('tipo'),
                    'badge.nivel' => 1,
                    'badge.imagem' => $imagem
                ]);

        }else{
            DB::table('badge')
                ->where("nomeb",'=',$npc->tipo)
                ->update([
                    'badge.nomeb' => request()->input('tipo'),
                    'badge.nivel' => 1,
                    'badge.imagem' => null
                ]);
        }
        if(request()->file('bd2')!=null) {
            $imagem = $this->converterImagem(request()->file('bd2'));
            DB::table('badge')
                ->where("nomeb",'=',$npc->tipo.'3')
                ->update([
                    'badge.nomeb' => request()->input('tipo').'3',
                    'badge.nivel' => 3,
                    'badge.imagem' => $imagem
                ]);
        }else{
            DB::table('badge')
                ->where("nomeb",'=',$npc->tipo.'3')
                ->update([
                    'badge.nomeb' => request()->input('tipo').'3',
                    'badge.nivel' => 3,
                    'badge.imagem' =>null
                ]);
        }
        if(request()->file('bd3')!=null) {
            $imagem = $this->converterImagem(request()->file('bd3'));
            DB::table('badge')
                ->where("nomeb",'=',$npc->tipo.'6')
                ->update([
                    'badge.nomeb' => request()->input('tipo').'6',
                    'badge.nivel' => 6,
                    'badge.imagem' => $imagem
                ]);
        }else{
            DB::table('badge')
                ->where("nomeb",'=',$npc->tipo.'6')
                ->update([
                    'badge.nomeb' => request()->input('tipo').'6',
                    'badge.nivel' => 6,
                    'badge.imagem' => null
                ]);
        }
        return redirect('/npcs/'.request()->input('tipo'));
    }
}
