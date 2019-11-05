<?php

namespace App\Http\Controllers;

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

<<<<<<< HEAD
    public function ver($nome, $iquest){

        $usuario = \App\Usuario::findOrFail($nome);

        $perguntas = DB::select('select * from pergunta where id_quest =?',[$iquest]);
        $count=0;
        for($i=1;$i<=3;$i++){
            for ($j=1;$j<=3;$j++){
                if( $perguntas[$i-1]->resposta == request()->input('opcao'.$i.$j)){
                    $count++;
                }
            }
        }

        if($count>=2){
            $aux=$usuario->gold + $usuario->nivel*500;
            $aux2=$usuario->nivel+1;
            DB::table('usuario')
                ->where("usuario.nomeu", '=', $usuario->nomeu)
                ->update(['usuario.gold' => $aux]);
            DB::table('usuario')
                ->where("usuario.nomeu", '=', $usuario->nomeu)
                ->update(['usuario.nivel' => $aux2]);
        }else{
            $aux=$usuario->gold - ($usuario->nivel/2)*500;
            DB::table('usuario')
                ->where("usuario.nomeu", '=', $usuario->nomeu)
                ->update(['usuario.gold' => $aux]);
        }
        return redirect('/usuarios/'.$usuario->nomeu );
    }

=======
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
>>>>>>> 2bc0daa7179bfb1a41c93663d96bccf3d5f21cb2
}
