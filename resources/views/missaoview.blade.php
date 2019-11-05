@extends('adminlte::layout')

@section('title','Missão View')
{{-- <img src="images/missao_back.jpg" id="bg" alt=""> --}}

<style>
    body{
        background-image: url('{{ asset ('images/missao_back.jpg')}}');
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

</style>

@section('content')
        <div style="margin-top:5%; margin-bottom:20%; width:50%; margin-left:25%; margin-right:25%">
            <div class="box box-solid" style="min-height:20%; max-width:100%">
                <div class="box-header">
                    <h3 style="text-align:center">{{$quest->informacao}}</h3>
                </div>
                <div class="box-body">
                    @php
                        $perguntas = DB::select('select * from pergunta where id_quest = ?', [$quest->id_quest]);
                    @endphp
                    @foreach ($perguntas as $pergunta)
                        <div class="form-group">
                            <p style="font-size:18px">{{$pergunta->descricao}}</p>
                             @php
                                $opcoes =  DB::select('select * from opcao where id_pergunta = ?', [$pergunta->id_pergunta]);
                            @endphp
                            @foreach ($opcoes as $opcao)
                                <div class="radio">
                                    <div class="o1">
                                        <ul>
                                            <li type="radio" name="opcao1" id="optionsRadios1" value="{{$opcao->indice}}" >
                                            {{$opcao->descricao}}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach  
                        </div>
                        <hr>
                    @endforeach
                    <form action="/npcs/{{$npc->tipo}}/{{$quest->id_quest}}" method="post">
                        @method('DELETE')
                        @csrf

                        <a href="#" class="btn bg-black">Editar</a>

                        <button type="submit" class="btn bg-black">Excluir</button>
                    </form>
                </div> 

            </div>

@endsection