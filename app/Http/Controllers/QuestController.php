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

}
