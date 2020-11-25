@extends('layouts.page')

@section('title', 'Tipos de produto ')
@section('content_header')
    <h1 class="m-0 text-dark">Tipos de produto</h1>
@stop

@section('content')
    @include('includes.alerts')
    <form class="row col-lg-12 col-sm-12" method="POST" action="{{ route('typeProduct.insert') }}">
        @csrf
        <div class="form-group col-lg-4 col-sm-12">
            <label>Nome</label>
            <input required type="text" name="name" class="form-control">
        </div>

        <div class="col-lg-12 col-sm-12">
            <input type="submit" class="btn btn-outline-info" value="Salvar">
        </div>
    </form>

    <div class="row col-lg-12 col-sm-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                    <tr class="type-{{$type->id}}">
                        <th scope="row">{{ $type->id }}</th>
                        <th scope="row">{{ $type->name }}</th>
                        <th scope="row">
                            <button id="{{ $type->id }}" class="btn btn-outline-danger delete-type">Excluir</button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/controllers/TypeProduct/TypeProductController.js') }}"></script>
    <script src="{{ asset('js/modules/typeProduct/index.js') }}"></script>
@endsection

