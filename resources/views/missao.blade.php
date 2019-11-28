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
                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                                            @if($pergunta->id_pergunta == $perguntas[0]->id_pergunta)
                                            <input type="checkbox" name="opcao{{$pergunta->id_pergunta}}{{$opcao->indice}}" id="optionsRadios1" value="{{$opcao->indice}}"
                                                   onclick="marcaDesmarca(this,1)">
                                            {{$opcao->descricao}}
                                            @elseif($pergunta->id_pergunta == $perguntas[1]->id_pergunta)
                                                <input type="checkbox" name="opcao{{$pergunta->id_pergunta}}{{$opcao->indice}}" id="optionsRadios1" value="{{$opcao->indice}}"
                                                       onclick="marcaDesmarca(this, 2)">
                                                {{$opcao->descricao}}
                                            @elseif($pergunta->id_pergunta ==$perguntas[2]->id_pergunta)
                                                <input type="checkbox" name="opcao{{$pergunta->id_pergunta}}{{$opcao->indice}}" id="optionsRadios1" value="{{$opcao->indice}}"
                                                       onclick="marcaDesmarca(this,3)">
                                                {{$opcao->descricao}}
                                            @endif
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

            </div>

        <script>
            function marcaDesmarca(caller,id) {
                var checks = document.querySelectorAll('input[type="checkbox"]');
                if(id==1){
                    for(let i = 0; i <=3; i++) {
                        checks[i].checked = checks[i] == caller;
                    }
                }
                if (id==2) {
                    for (let i = 4; i <= 7; i++) {
                        checks[i].checked = checks[i] == caller;
                    }
                }
                if (id==3) {
                    for (let i = 8; i <= 11; i++) {
                        checks[i].checked = checks[i] == caller;
                    }
                }
            }
        </script>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog success" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-green">
                        <h5 class="modal-title" id="exampleModalLabel">Missão Concluida com sucesso!</h5>
                    </div>
                    <div class="modal-body">
                        Parabéns nobre guerreiro você concluiu a missão de "{{$quest->informacao}}"!
                    </div>
                    <div class="modal-footer">
                        <a class="btn bg-green" href="/usuarios/{{$usuario->nomeu}}">Continuar Jornada</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog success" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <h5 class="modal-title" id="exampleModalLabel">Missão Não Concluida!</h5>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset ('images/errou.jpg')}}" id="profile_picture" alt="" style="padding-left: 30%"></img>
                        <h4>Então nobre guerreiro, você falhou a missão de "{{$quest->informacao}}"!</h4>
                    </div>
                    <div class="modal-footer">
                        <a class="btn bg-red" href="/usuarios/{{$usuario->nomeu}}">Continuar Jornada</a>
                    </div>
                </div>
            </div>
        </div>


        @if(Session::has('mensagem'))
            @if(Session::get('mensagem') == 'sim')
                <script>
                    $(document).ready(function () {
                        $('#myModal').modal('show');
                    })
                </script>
             @elseif(Session::get('mensagem') == 'nao')
                <script>
                    $(document).ready(function () {
                        $('#myModal2').modal('show');
                    })
                </script>
             @endif
        @endif

@endsection
