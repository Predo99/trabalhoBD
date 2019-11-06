@extends('adminlte::layout')

@section('title','Criar Missões')

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
</style>
@section('content')
    <div style="width:50%; margin-left:25%; margin-right:25%">
            <div class="box box-solid" style="max-width:100%">
            <h3 style="text-align:center; padding-top:1%;">Criar Missão</h3>
            <div class="box-body">
                <form action="/criar/{{$npc->tipo}}/st" method="post">
                    <div class="form-group">
                        <lavel><strong>Nível da Missão:</strong></lavel>
                        <input class="form-control" name="lvl" placeholder="Ex: 2">
                        <lavel><strong>Informação da Missão:</strong></lavel>
                        <input class="form-control" name="info" placeholder="Ex: Derrote o HellTon">
                        <lavel><strong>Pergunta 1:</strong></lavel>
                        <textarea class="form-control" name="pgt1" rows="3" placeholder="Ex: O triplo de um número natural somado a 4 é igual ao quadrado de 5. Calcule-o:"></textarea>
                        <lavel><strong>Opção de resposta 1:</strong></lavel>
                        <input class="form-control" name="r11" placeholder="Ex: 5">
                        <lavel><strong>Opção de resposta 2:</strong></lavel>
                        <input class="form-control" name="r12" placeholder="Ex: 7">
                        <lavel><strong>Opção de resposta 3:</strong></lavel>
                        <input class="form-control" name="r13" placeholder="Ex: 9">
                        <lavel><strong>Opção de resposta 4:</strong></lavel>
                        <input class="form-control" name="r14" placeholder="Ex: 15">
                        <lavel><strong>Marque a opção da Resposta Correta</strong></lavel>
                        <div class="radio">
                                <label>
                                    <input type="checkbox" name="opcao11" id="optionsRadios1" value=1 >
                                    1
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao12" id="optionsRadios2" value=2 >
                                    2
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao13" id="optionsRadios2" value=3 >
                                    3
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao14" id="optionsRadios2" value=4 >
                                    4
                                </label>
                        </div>
                        <hr>
                        <lavel><strong>Pergunta 2:</strong></lavel>
                        <textarea class="form-control" name="pgt2" rows="3" placeholder="Ex: O triplo de um número natural somado a 4 é igual ao quadrado de 5. Calcule-o:"></textarea>
                        <lavel><strong>Opção de resposta 1:</strong></lavel>
                        <input class="form-control" name="r21" placeholder="Ex: 5">
                        <lavel><strong>Opção de resposta 2:</strong></lavel>
                        <input class="form-control" name="r22" placeholder="Ex: 7">
                        <lavel><strong>Opção de resposta 3:</strong></lavel>
                        <input class="form-control" name="r23" placeholder="Ex: 9">
                        <lavel><strong>Opção de resposta 4:</strong></lavel>
                        <input class="form-control" name="r24" placeholder="Ex: 15">
                        <lavel><strong>Marque a opção da Resposta Correta</strong></lavel>
                        <div class="radio">
                                <label>
                                    <input type="checkbox" name="opcao21" id="optionsRadios1" value=1 >
                                    1
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao22" id="optionsRadios2" value=2 >
                                    2
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao23" id="optionsRadios2" value=3 >
                                    3
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao24" id="optionsRadios2" value=4 >
                                    4
                                </label>
                        </div>
                        <hr>
                        <lavel><strong>Pergunta 3:</strong></lavel>
                        <textarea class="form-control" name="pgt3" rows="3" placeholder="Ex: O triplo de um número natural somado a 4 é igual ao quadrado de 5. Calcule-o:"></textarea>
                        <lavel><strong>Opção de resposta 1:</strong></lavel>
                        <input class="form-control" name="r31" placeholder="Ex: 5">
                        <lavel><strong>Opção de resposta 2:</strong></lavel>
                        <input class="form-control" name="r32" placeholder="Ex: 7">
                        <lavel><strong>Opção de resposta 3:</strong></lavel>
                        <input class="form-control" name="r33" placeholder="Ex: 9">
                        <lavel><strong>Opção de resposta 4:</strong></lavel>
                        <input class="form-control" name="r34" placeholder="Ex: 15">
                        <lavel><strong>Marque a opção da Resposta Correta</strong></lavel>
                        <div class="radio">
                                <label>
                                    <input type="checkbox" name="opcao31" id="optionsRadios1" value=1 >
                                    1
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao32" id="optionsRadios2" value=2 >
                                    2
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao33" id="optionsRadios2" value=3 >
                                    3
                                </label>
                                <label>
                                    <input type="checkbox" name="opcao34" id="optionsRadios2" value=4 >
                                    4
                                </label>
                        </div>
                    </div>
                    <hr>
                    @csrf
                    <button class="btn bg-black">Confirmar</button>

                    <a href="{{ URL::previous() }}" class="btn bg-black">Voltar</a>
                </form>


                </div>
            </div>

        </div>
@endsection
