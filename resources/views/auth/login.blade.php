@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @yield('css')
@stop

<style>
    body {
        height: auto;
        background: url("/images/rpg.jpg") repeat scroll 0 0 / cover rgba(0, 0, 0, 0) !important;
    }
</style>

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <h1 style="text-align:center; font-weight: bold;">LOGIN</h1>
            {{-- <p class="login-box-msg">{{ __('adminlte::adminlte.login_message') }}</p> --}}
            <form action="{{route('usuario.login.submit')}}" method="post" >
                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('nomeu') ? 'has-error' : '' }}">
                    <input type="text" name="nomeu" class="form-control" value="{{ old('nomeu') }}" placeholder="Nome">
                    @if ($errors->has('nomeu'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nomeu') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('senha') ? 'has-error' : '' }}">
                    <input type="password" name="senha" class="form-control" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('senha'))
                        <span class="help-block">
                            <strong>{{ $errors->first('senha') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Entrar
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>
            <p>
                <a href="#" class="text-center">
                    Cadastrar usuário
                </a>
            </p>
            <p>
                <a href="#" class="text-center">
                    Cadastrar NPC
                </a>
            </p>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
