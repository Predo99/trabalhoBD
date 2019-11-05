<?php

namespace App\Http\Controllers;

use App\Npc;
use Illuminate\Http\Request;

class NpcController extends Controller
{
    public function show(Npc $npc)
    {
        return view('homenpc', compact('npc'));
    }
}
