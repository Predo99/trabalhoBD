<?php

namespace App\Http\Controllers;

use App\Npc;
use App\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
{
    public function show ($nome, Quest $quest)
    {
        $usuario = \App\Usuario::findOrFail($nome);
        return view('missao', compact('usuario', 'quest'));
    }

    public function ver($nome, $iquest,$data,$hora){

        $usuario = \App\Usuario::findOrFail($nome);

        $perguntas = DB::select('select * from pergunta where id_quest =?',[$iquest]);
        $count=0;
       for($i=0;$i<3;$i++){
           if(request()->input('opcao'.$perguntas[$i]->id_pergunta.$perguntas[$i]->resposta)){
               $count++;
           }
       }

        $quest = Quest::findOrFail($iquest);
        $status=0;
        if($count>=2){
            DB::table('usuario')
                ->where("usuario.nomeu", '=', $usuario->nomeu)
                ->update(['usuario.gold' => $usuario->gold + $quest->nivel*500]);
            DB::table('usuario')
                ->where("usuario.nomeu", '=', $usuario->nomeu)
                ->update(['usuario.nivel' => $usuario->nivel+1]);
            $status='Aprovado';
        }else{
            DB::table('usuario')
                ->where("usuario.nomeu", '=', $usuario->nomeu)
                ->update(['usuario.gold' => $usuario->gold - ($quest->nivel/2)*500]);
            $status='Reprovado';
        }

        date_default_timezone_set('America/Sao_Paulo');
        $dataf = date('d-m-y');
        $horaf = date('h:i:s');

        DB::insert('insert into realiza (nomeu,id_quest,status,data_ini,data_fim,hora_ini,hora_fim) values(?,?,?,?,?,?,?)',
        [$usuario->nomeu,$quest->id_quest,$status,$data,$dataf,$hora,$horaf]);


        return redirect('/usuarios/'.$usuario->nomeu );

    }
    // public function showq(Quest $quest)
    // {
    //     return view('missaoview', compact('quest'));
    // }

    public function showq ($tipo, Quest $quest)
    {
        $npc = \App\Npc::findOrFail($tipo);
        return view('missaoview', compact('npc', 'quest'));
    }

    public function destroy($npc, Quest $quest)
    {
        $NPC = DB::select('select * from npc where tipo = ?', [$npc]);
        $deleted = DB::delete('delete from quest where id_quest = ?', [$quest->id_quest]);

        return redirect('/npcs/'. $NPC[0]->tipo);
    }

    public function create($tipo){
        $npc = Npc::findOrFail($tipo);
        $quest = new Quest();

        return view('/criar',compact('quest','npc'));
    }

    public function store($tipo){

        $aux=[0];
        for($i=1;$i<=3;$i++){
            for ($j=1;$j<=4;$j++) {
                if (request()->input('opcao'.$i.$j) != null) {
                    $aux[$i-1] = $j;
                }
            }
        }

         DB::insert('insert into quest (tipo,nivel,informacao) values (?,?,?)',
             [$tipo,request()->input('lvl'),request()->input('info')]);

         $max = DB::select('select id_quest from quest where id_quest=(select max(id_quest) from quest)');

         DB::insert('insert into pergunta (descricao,resposta,id_quest) values (?,?,?)',
             [request()->input('pgt1'),$aux[0],$max[0]->id_quest]);
         DB::insert('insert into pergunta (descricao,resposta,id_quest) values (?,?,?)',
             [request()->input('pgt2'),$aux[1],$max[0]->id_quest]);
         DB::insert('insert into pergunta (descricao,resposta,id_quest) values (?,?,?)',
             [request()->input('pgt3'),$aux[2],$max[0]->id_quest]);

         $id_pgt = DB::select('select * from pergunta where id_quest =(select id_quest from quest where id_quest=(select max(id_quest) from quest))');

         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [1, $id_pgt[0]->id_pergunta ,request()->input('r11')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [2, $id_pgt[0]->id_pergunta ,request()->input('r12')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [3, $id_pgt[0]->id_pergunta ,request()->input('r13')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [4, $id_pgt[0]->id_pergunta ,request()->input('r14')]);

         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [1, $id_pgt[1]->id_pergunta ,request()->input('r21')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [2, $id_pgt[1]->id_pergunta ,request()->input('r22')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [3, $id_pgt[1]->id_pergunta ,request()->input('r23')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [4, $id_pgt[1]->id_pergunta ,request()->input('r24')]);

         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [1, $id_pgt[2]->id_pergunta ,request()->input('r31')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [2, $id_pgt[2]->id_pergunta ,request()->input('r32')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [3, $id_pgt[2]->id_pergunta ,request()->input('r33')]);
         DB::insert('insert into opcao (indice,id_pergunta,descricao) values (?,?,?)',
             [4, $id_pgt[2]->id_pergunta ,request()->input('r34')]);


        return redirect('/npcs/'.$tipo);
    }
}
