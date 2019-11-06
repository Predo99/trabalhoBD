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

    public function store(){

       DB::insert('insert into npc (nomen,senha,tipo) values (?,?,?)' ,
           [request()->input('nomen'),request()->input('senha'),request()->input('tipo')]);
       return redirect('/');
    }
}
