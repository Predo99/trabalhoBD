@extends('adminlte::layout')

@section('title', 'HomeNPC')

<style>
    body{
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
</style>

@section('content')
    <div class="row">
        <div class="bg-black" style="width:25%; max-height:100%;  position:absolute; top:0; bottom:0;">
            <div>
                <a href="/{{$npc->tipo}}/edit"><h1 style="text-align:center"  >{{$npc->nomen}}</h1></a>
                @if($npc->imagem == null)
                    <img src="{{ asset ('images/npcdefault.jpg')}}" id="profile_picture" alt=""></img>
                @else
                    <img src="data:image/jpeg;base64,{{$npc->imagem}}" id="profile_picture" alt=""></img>
                @endif
            </div>
            <div>
                <h3 style="display:inline-block; margin-left:3%">
                    Tipo:
                    <h3 style="display:inline-block;">{{$npc->tipo}}</h3>
                </h3>
            </div>
            <div>
                <h3 style="margin-left:3%">Missões: </h3>
                <ul>
                    @php
                    $missoes = DB::select('select * from quest where tipo = ?', [$npc->tipo]);
                    @endphp
                    @foreach ($missoes as $missao)
                        <li>
                            <a href="{{ route('quests.showq', ['npc' => $npc->tipo, 'quest' => $missao->id_quest]) }}"><h3>Nível: {{$missao->nivel}}</h3></a>
                        </li>
                    @endforeach
                 </ul>
            </div>
                <a href="/npc">
                    <i class="fa fa-fw fa-power-off" style="font-size: 30px; position:absolute; top: 1%; left: 2%; color:white;  "></i>
                </a>
        </div>
    </div>

    <div class="row">
        <div class="bg-black" style="margin-left:30%; margin-right:10%; max-width:60%">
            <h1 style="text-align:center; padding-top:1%;">Criar missão</h1>
            <div style="padding-left:35%; padding-bottom:1%;  margin: auto" >
                <a class="btn bg-blue" href="/criar/{{$npc->tipo}}">
                        <h3 alt="" data-toggle="tooltip" data-placement="top" title="Clique aqui para adicionar uma nova missão">Criar missão</h3>
                </a>
            </div>

            {{-- <ul style="white-space:nowrap; padding-bottom:1%; margin-left:10%; margin-right:85%;">
                @php
                    $missoes = DB::select('select * from quest where nivel = ?', [$usuario->nivel]);
                @endphp

                @foreach ($missoes as $missao)
                    <li>
                        <a class="btn btn-primary"
                        href="{{ route('quests.show', ['usuario' => $usuario->nomeu, 'quest' => $missao->id_quest]) }}" >
                        <h3>{{$missao->tipo}}{{$missao->nivel}}</h3></a>
                    </li>
                @endforeach
            </ul> --}}
        </div>
    </div>
@endsection
