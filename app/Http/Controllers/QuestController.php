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
}
