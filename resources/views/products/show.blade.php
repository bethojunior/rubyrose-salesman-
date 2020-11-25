@extends('layouts.page')

@section('title', 'Listagem de produtos')
@section('content_header')
    <h1 class="m-0">Produtos</h1>
@stop

@section('content')
    @include('includes.alerts')
    <link href="{{ asset('css/products/index.css') }}" rel="stylesheet">
    <div class="row col-lg-12 col-sm-12 div-products">
        <div class="row col-lg-12 col-sm-12 ">
            <div class="form-group col-sm-12 col-lg-12">
                <span>Tipo de produtos</span>
                <select id="product-types" class="form-control col-sm-12">
                    <option value="all">Todos</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12 col-sm-12">
                <span>Nome</span>
                <input id="search-product" class="form-control" placeholder="Busque um produto aqui">
            </div>
        </div>
        @foreach($products as $product)
            <div title="{{ $product->name }}" type="{{ $product->type_product_id }}" style="padding-top: 2vw" class="card col-lg-4 col-sm-12 product">
                <div  id="carouselExampleControls{{$product->id}}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active item-carousel">
                            <img src="{{ asset('assets/images/logo/logo.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        @foreach($product->images as $image)
                            <div class="carousel-item">
                                <img src="{{\App\Constants\ImageConstant::PATH.$image->image }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls{{$product->id}}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls{{$product->id}}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="card-body">
                    <h5 class="card-title"><label for="">{{ $product->name }}</label></h5>
                    <p class="card-text"><label for="">{{ $product->description }}</label></p>
                    <p>
                        <span>Valor : R$ {{ $product->value }}</span>
                    </p>
                    <p>
                        <span>Pedido minimo : {{ $product->minimum_order }} unidades</span>
                    </p>
                    <p>
                        <span>Tipo do produto : {{ $product->type[0]['name'] }}</span>
                    </p>

{{--                    <a href="#" class="btn btn-primary">Go somewhere</a>--}}
                    <div class="card-footer">
                        <small class="text-muted">
                            <input readonly style="text-align: center" class="form-control" type="number" product="{{ $product->id }}" value="{{ $product->minimum_order }}" id="qtd-{{$product->id}}" min="{{ $product->minimum_order }}" value="{{ $product->minimum_order }}">
                            <div class="center" style="margin-top: 2vw">
                                <button product="{{ $product }}" class="btn btn-outline-info add-item" id="product-{{ $product->id }}" style="margin-right: 2vw">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </button>
                                <button product="{{ $product }}" class="btn btn-outline-danger remove-item" id="product-{{ $product->id }}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="center" style="margin-top: 1vw">
                                <button class="btn btn-outline-info add-bag" data="{{ $product }}" id="{{ $product->id }}">
                                    <label>Adcionar a sacola</label>
                                </button>
                            </div>
                        </small>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@stop

@section('js')
    <script src="{{ asset('js/controllers/TypeProduct/TypeProductController.js') }}"></script>
    <script src="{{ asset('js/modules/products/list.js') }}"></script>
@endsection
