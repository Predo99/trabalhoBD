@extends('adminlte::layout')

@section('title','Criar Usuário')

<style>
    body{
        background-image: url('/images/rpg.jpg');
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
            <h3 style="text-align:center; padding-top:1%;">Criar Usuário</h3>
            <div class="box-body">
                <div class="form-group">
                    <form action="/st" method="post">
                        <label><strong>Nome :</strong></label>
                        <input class="form-control" name="nomeu" id="nomeu" type="text" placeholder="Nome">
                        @error('nomeu') <b style="color:red">{{$message}}</b> @enderror
                        <label><strong>Senha :</strong></label>
                        <input class="form-control" name="senha" id="senha" type="password">
                        @error('senha') <b style="color:red">{{$message}}</b> @enderror
                        <hr>
                        @csrf
                        <button type="submit" class="btn bg-black">Confirmar</button>
                        <a href="{{ URL::previous() }}" class="btn bg-black">Voltar</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
