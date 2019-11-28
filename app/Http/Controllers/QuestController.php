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
        $quest = Quest::findOrFail($iquest);

                $perguntas = DB::select('select * from pergunta where id_quest =?',[$iquest]);
                $count=0;
               for($i=0;$i<3;$i++){
                   if(request()->input('opcao'.$perguntas[$i]->id_pergunta.$perguntas[$i]->resposta)){
                       $count++;
                   }
               }

                if($count>=2){
                    DB::table('usuario')
                        ->where("usuario.nomeu", '=', $usuario->nomeu)
                        ->update(['usuario.gold' => $usuario->gold + $quest->nivel*500]);
                    DB::table('usuario')
                        ->where("usuario.nomeu", '=', $usuario->nomeu)
                        ->update(['usuario.nivel' => $usuario->nivel+1]);

                    date_default_timezone_set('America/Sao_Paulo');
                    $dataf = date('d-m-y');
                    $horaf = date('h:i:s');

                    DB::insert('insert into realiza (nomeu,id_quest,data_ini,data_fim,hora_ini,hora_fim) values(?,?,?,?,?,?)',
                        [$usuario->nomeu,$quest->id_quest,$data,$dataf,$hora,$horaf]);
                    return redirect()->back()->with('mensagem', 'sim');


                }else{
                    DB::table('usuario')
                        ->where("usuario.nomeu", '=', $usuario->nomeu)
                        ->update(['usuario.gold' => $usuario->gold - ($quest->nivel/2)*500]);
                }

                  $teste=  DB::select('select count(*) from ganha where nomeu=? and nomeb=?',[$usuario->nomeu,$quest->tipo]);
                  if($teste[0]->count ==0) {
                      DB::insert('insert into ganha (nomeu,nomeb) values (?,?)',
                          [$usuario->nomeu,$quest->tipo]);
                  }
                if($usuario->nivel>=3){
                    $tester=  DB::select('select count(*) from realiza as r, quest as q  where nomeu=? and q.tipo = ? and q.id_quest=r.id_quest',
                        [$usuario->nomeu,$quest->tipo]);
                    if($tester[0]->count == 3){
                        DB::insert('insert into ganha (nomeu,nomeb) values (?,?)',
                            [$usuario->nomeu,$quest->tipo.'3']);
                    }
                }
                if($usuario->nivel>=6){
                    $tester=  DB::select('select count(*) from realiza as r, quest as q  where nomeu=? and q.tipo = ? and q.id_quest=r.id_quest',
                        [$usuario->nomeu,$quest->tipo]);
                    if($tester[0]->count == 6){
                        DB::insert('insert into ganha (nomeu,nomeb) values (?,?)',
                            [$usuario->nomeu,$quest->tipo.'3']);
                    }
                }
        return redirect()->back()->with('mensagem', 'nao');


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
