@extends('layouts.page')

@section('title', 'Cadastrar usuário ')
@section('content_header')
    <h1 class="m-0 text-dark">Cadastrar de usuários</h1>
@stop

@section('content')
    <form class="row col-lg-12 col-sm-12" method="POST" action="{{ route('user.insert') }}">
        @csrf
        <div class="form-group col-lg-4 col-sm-12">
            <label>Nome</label>
            <input required type="text" name="name" class="form-control">
        </div>
        <div class="form-group col-lg-4 col-sm-12">
            <label>Email</label>
            <input required type="email" name="email" class="form-control">
        </div>
        <div class="form-group col-lg-4 col-sm-12">
            <label>Senha</label>
            <input required type="text" name="password" class="form-control">
        </div>
        <div class="form-group col-lg-4 col-sm-12">
            <label>Fone</label>
            <input required type="tel" name="phone" class="form-control">
        </div>
        <div class="form-group col-lg-4 col-sm-12">
            <label for="exampleFormControlSelect1">Tipo de usuário</label>
            <select required name="user_type_id" class="form-control" id="exampleFormControlSelect1">
                <option value="{{ \App\Constants\UserConstant::ADMIN }}">Admin</option>
                <option value="{{ \App\Constants\UserConstant::REVENDEDORA }}">Revendedor</option>
            </select>
        </div>
        <div class="col-lg-12 col-sm-12">
            <input type="submit" class="btn btn-outline-info" value="Salvar">
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('js/modules/user/list.js') }}"></script>
@endsection

