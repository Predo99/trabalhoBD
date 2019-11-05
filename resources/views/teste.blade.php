@extends('adminlte::layout')

@section('title', 'Home')

@section('content')
    @foreach ($quests as $usuario)
        <a href="{{ route('quests.show', ['usuario' => $usuario->nomeu]) }}">{{$usuario->nomeu}}</a>
        <p>{{$usuario->nivel}}</p>
        <p>{{$usuario->gold}}</p>
    @endforeach
@endsection