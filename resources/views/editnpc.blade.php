@extends('adminlte::layout')

@section('title','Criar NPC')

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
            <h3 style="text-align:center; padding-top:1%;">Editar NPC</h3>
            <div class="box-body">
                <div class="form-group">
                    <form action="/{{$npc->tipo}}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        <label><strong>Nome NPC :</strong></label>
                        <input class="form-control" name="nomen" id="nomen" type="text" placeholder="Nome" autocomplete="off" value="{{old('name') ?? $npc->nomen}}">
                        @error('nomen') <b style="color:red">{{$message}}</b> @enderror
                        <label><strong>Tipo NPC :</strong></label>
                        <input class="form-control" name="tipo" id="tipo" type="text" placeholder="Tipo" autocomplete="off" value="{{old('name') ?? $npc->tipo}}">
                        @error('tipo') <b style="color:red">{{$message}}</b> @enderror
                        <label><strong>Senha NPC :</strong></label>
                        <input class="form-control" name="senha" id="senha" type="password" autocomplete="off" value="{{old('name') ?? $npc->senha}}">
                        @error('senha') <b style="color:red">{{$message}}</b> @enderror
                        <div class="form-group d-flex flex-column">
                            <label for="imagem">Foto de Perfil</label>
                            <input type="file" name="imagem" class="py-2">
                            <div>{{ $errors->first('imagem') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="bd1">Badge1 Image</label>
                            <input type="file" name="bd1" class="py-2">
                            <div>{{ $errors->first('bd1') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="bd2">Badge2 Image</label>
                            <input type="file" name="bd2" class="py-2">
                            <div>{{ $errors->first('bd2') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="bd3">Badge3 Image</label>
                            <input type="file" name="bd3" class="py-2">
                            <div>{{ $errors->first('bd3') }}</div>
                        </div>
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
