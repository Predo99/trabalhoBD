@extends('adminlte::layout')

@section('title','Criar Missões')

<style>
   body{    
        background-image: url(images/tavern.jpg);
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
            <div class="box box-solid" style="min-height:100%; max-width:100%">
            <h3 style="text-align:center; padding-top:1%;">Criar Missão</h3>
            <div class="box-body">
                <div class="form-group">
                    <lavel><strong>Nível da Questão:</strong></lavel>
                    <input class="form-control" name="lvl" placeholder="Ex:2">
                    <lavel><strong>Pergunta:</strong></lavel>
                    <textarea class="form-control" rows="3" placeholder="Ex: O triplo de um número natural somado a 4 é igual ao quadrado de 5. Calcule-o:"></textarea>
                    <lavel><strong>Opção de resposta 1:</strong></lavel>
                    <input class="form-control" name="r1" placeholder="Ex:5">
                    <lavel><strong>Opção de resposta 2:</strong></lavel>
                    <input class="form-control" name="r2" placeholder="Ex:7">
                    <lavel><strong>Opção de resposta 3:</strong></lavel>
                    <input class="form-control" name="r3" placeholder="Ex:9">
                    <lavel><strong>Opção de resposta 4:</strong></lavel>
                    <input class="form-control" name="r4" placeholder="Ex:15">
                    <lavel><strong>Marque a opção da Resposta Correta</strong></lavel>
                    <div class="radio">
                            <label>
                                <input type="radio" name="tipoEstagio" id="optionsRadios1" value="option1"  >
                                1
                            </label>
                            <label>
                                <input type="radio" name="tipoEstagio" id="optionsRadios2" value="option2" >
                                2
                            </label>
                            <label>
                                <input type="radio" name="tipoEstagio" id="optionsRadios2" value="option2" >
                                3
                            </label>
                            <label>
                                <input type="radio" name="tipoEstagio" id="optionsRadios2" value="option2" >
                                4
                            </label>
                    </div>
                    <hr>
                    <a href="/criar" class="btn bg-black">Confirmar</a>
                </div>
            </div>

        </div>
@endsection
