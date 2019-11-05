<?php

namespace App\Http\Controllers;

use App\Quest;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function show ($nome, Quest $quest)
    {
        $usuario = \App\Usuario::findOrFail($nome);
        return view('missao', compact('usuario', 'quest'));
    }
}
