@extends('layouts.page')

@section('title', 'Listagem de produtos')
@section('content_header')
    <div class="center">
        <h1 class="m-0">Produtos</h1>
    </div>
@stop

@section('content')
    @include('includes.alerts')
    <link href="{{ asset('css/products/index.css') }}" rel="stylesheet">
    <input id="user-logged" type="hidden" value="{{ \Illuminate\Support\Facades\Auth::user() }}">
    <div class="finish-bag">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>
    </div>

    <div class="row col-lg-12 col-sm-12 div-products">
        <div class=" col-lg-12 col-sm-12 ">
            <div class="form-group col-sm-12 col-lg-12">
                <span class="center">Tipo de produtos</span>
                <select id="product-types" class="form-control col-sm-12">
                    <option value="all">Todos</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12 col-sm-12">
                <span class="center">Nome</span>
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
                        Cor : <span style="background-color: {{ $product->color }}" class="badge">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </p>
                    <p>
                        <span>Valor : R$ {{ $product->value }}</span>
                    </p>
                    <p>
                        <span>Pedido minimo : {{ $product->minimum_order }} unidades</span>
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
                            <div class="center" style="margin-top: 2vw">
                                <button class="btn btn-outline-info add-bag" data="{{ $product }}" id="{{ $product->id }}">
                                    <label>Adicionar a sacola</label>
                                </button>
                            </div>
                        </small>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    <div id="modal-orders" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Meu carrinho</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mount-orders">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar pedido</button>
                    <button id="send-order" type="button" class="btn btn-primary">Enviar pedido</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="{{ asset('js/controllers/Sales/SalesController.js') }}"></script>
    <script src="{{ asset('js/modules/products/list.js') }}"></script>
@endsection
