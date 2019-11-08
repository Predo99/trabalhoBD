@extends('adminlte::layout')

@section('title', 'Home')

<style>
    body{
        position: fixed;
        top: 0;
        left: 0;
        background-image: url('{{ asset ('images/tavern.jpg')}}');
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100vh;
        /* Preserve aspet ratio */
        min-width: 100%;
        min-height: 100%;
    }

    #profile_picture{
        width: 65%;
        height: 25%;
        border-radius: 50%;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    li.a{
        display:inline-block;
        padding-inline-start: 5%;
    }
    li.b{
        list-style-type: none;
        margin-left:3%
    }

</style>

@section('content')
    <div class="row">
        <div class="bg-black" style="width:20%; height:100%; position:absolute; top:0; bottom:0;">
            <div>
                <h1 style="text-align:center">{{$usuario->nomeu}}</h1>
                <img src="{{asset('images/warrior.jpg')}}" id="profile_picture" alt=""></img>
            </div>
            <div>
                <h3 style="display:inline-block; margin-left:3%">
                    Nível:
                    <h3 style="display:inline-block;"> {{$usuario->nivel}}</h3>
                </h3>
            </div>
            <div>
                <h3 style="display:inline-block; margin-left:3%">
                    Dinheiro: R$
                    <h3 style="display:inline-block;"> {{$usuario->gold}}</h3>
                </h3>
            </div>
            <div>
                <h3 style="margin-left:3%">Badges: </h3>
                @php
                    $badgesganhas = DB::select('select * from ganha where nomeu = ?', [$usuario->nomeu]);
                @endphp
                @foreach ($badgesganhas as $badgeganha)
                    @php
                        $badge = DB::select('select * from badge where nomeb = ?', [$badgeganha->nomeb]);
                    @endphp
                    <li class="b" style="color:red"><h3>{{$badge[0]->nomeb}} {{$badge[0]->nivel}}</h3></li>
                @endforeach
            </div>
            <div>
                <a href="">
                    <i class="fa fa-fw fa-power-off" style="font-size: 30px; position:absolute; bottom:1%; right:2%; color:white;  "></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="bg-black" style="margin-left:30%; margin-right:10%; max-width:60%">
            <h1 style="text-align:center; padding-top:1%;">Missões</h1>
            <ul style="white-space:nowrap; padding-bottom:1%; margin-left:10%; margin-right:85%;">
                @php
                    $missoes = DB::select('select * from quest where nivel = ?', [$usuario->nivel]);
                @endphp

                @foreach ($missoes as $missao)
                    <li class="a">
                        <a class="btn btn-primary"
                        href="{{ route('quests.show', ['usuario' => $usuario->nomeu, 'quest' => $missao->id_quest]) }}" >
                        <h3>{{$missao->tipo}}{{$missao->nivel}}</h3></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
