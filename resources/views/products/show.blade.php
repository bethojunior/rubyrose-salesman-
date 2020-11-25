@extends('layouts.page')

@section('title', 'Listagem de produtos')
@section('content_header')
    <h1 class="m-0 text-dark">Produtos</h1>
@stop

@section('content')
    @include('includes.alerts')
{{--    {{ dd($products) }}--}}
    <div class="row col-lg-12 col-sm-12">
        @foreach($products as $product)
            <div class="card col-lg-4 col-sm-12">
                <div id="carouselExampleControls{{$product->id}}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active item-carousel">
                            <img src="{{ asset('assets/images/logo/logo.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        @foreach($product->images as $image)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/').'/'.$image->image }}" class="d-block w-100" alt="...">
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
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('js')
    <script src="{{ asset('js/controllers/TypeProduct/TypeProductController.js') }}"></script>
    <script src="{{ asset('js/modules/products/list.js') }}"></script>
@endsection
