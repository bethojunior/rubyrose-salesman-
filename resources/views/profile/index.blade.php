@extends('layouts.page')

@section('title', 'Cadastrar usuário ')
@section('content_header')
    <h1 class="m-0 text-dark">Meu perfil</h1>
@stop

@section('content')
    @include('includes.alerts')
    <form class="row col-lg-12 col-sm-12" method="POST" action="{{ route('user.update') }}">
        @method('PUT')
        @csrf
        <input type="hidden" name='id' value="{{ $user->id }}">
        <div class="form-group col-lg-4 col-sm-12">
            <label>Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="form-group col-lg-4 col-sm-12">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="form-group col-lg-4 col-sm-12">
            <label>Senha</label>
            <input required type="text" name="password" class="form-control" >
        </div>
        <div class="form-group col-lg-4 col-sm-12">
            <label>Fone</label>
            <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>
        <div class="col-lg-12 col-sm-12">
            <input type="submit" class="btn btn-outline-info" value="Salvar alterações">
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('js/modules/user/list.js') }}"></script>
@endsection

