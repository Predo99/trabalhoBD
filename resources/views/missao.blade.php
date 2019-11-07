@extends('adminlte::layout')

@section('title','Missões')
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
                @php
                date_default_timezone_set('America/Sao_Paulo');
                $data = date('d-m-y');
                $hora = date('h:i:s');
                @endphp
                <div class="box-header">
                    <h3 style="text-align:center">{{$quest->informacao}}</h3>
                </div>
                <div class="box-body">
                    @php
                        $perguntas = DB::select('select * from pergunta where id_quest = ?', [$quest->id_quest]);
                    @endphp
                    <form action="{{ route('missoes.ver',
                     ['usuario' => $usuario->nomeu, 'quest' => $quest->id_quest ,'data' =>$data,'hora' =>$hora]) }}" method="post">
                    @foreach ($perguntas as $pergunta)
                        <div class="form-group" >
                            <p style="font-size:18px">{{$pergunta->descricao}}</p>
                             @php
                                $opcoes =  DB::select('select * from opcao where id_pergunta = ?', [$pergunta->id_pergunta]);
                            @endphp
                            @foreach ($opcoes as $opcao)
                                <div class="radio">
                                    <div class="o1">
                                        <label>
                                            <input type="checkbox" name="opcao{{$pergunta->id_pergunta}}{{$opcao->indice}}" id="optionsRadios1" value="{{$opcao->indice}}" >
                                            {{$opcao->descricao}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endforeach
                        <hr>
                        @csrf
                    <button class="btn bg-black">Responder</button>
                    </form>
                </div>

            </div>

@endsection
