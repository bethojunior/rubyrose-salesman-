@extends('layouts.page')

@section('title', 'Inserir produtos')
@section('content_header')
    <h1 class="m-0 text-dark">Inserir Produtos</h1>
@stop

@section('content')
    @include('includes.alerts')
    <form class="row col-lg-12 col-sm-12" method="POST" action="{{ route('products.insert') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-lg-4 col-sm-12">
            <span>Nome</span>
            <input required type="text" name="name" class="form-control">
        </div>

        <div class="form-group col-lg-4 col-sm-12">
            <span>Tipo</span>
            <select class="col-lg-12 col-sm-12 js-example-basic-single form-control" name="type_product_id">
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-2 col-sm-12">
            <span>Valor</span>
            <input id="value-product" required type="text" name="value" class="form-control">
        </div>

        <div class="form-group col-lg-2 col-sm-12">
            <span>Qtd Mininma</span>
            <input required type="number" name="minimum_order" class="form-control">
        </div>

        <div class="form-group col-lg-12 col-sm-12">
            <span>Descrição</span>
            <textarea class="form-control" name="description" id="" cols="10" rows="5"></textarea>
        </div>

        <div class="col-sm-12 col-lg-12">
            <input required id="input-b3" name="images[]" type="file" class="file" multiple
                   data-show-upload="false" data-show-caption="true" data-msg-placeholder="Selecione imagens para upload">
        </div>

        <div class="col-lg-12 col-sm-12" style="margin-top: 2vw">
            <input type="submit" class="btn btn-success" value="Salvar">
        </div>
    </form>

@stop

@section('js')
    <script src="{{ asset('js/controllers/TypeProduct/TypeProductController.js') }}"></script>
    <script src="{{ asset('js/modules/products/index.js') }}"></script>
@endsection
