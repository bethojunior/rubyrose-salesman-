@extends('layouts.page')

@section('title', 'Meu histórico')
@section('content_header')
    <div class="center">
        <h1 class="m-0">Meu histórico</h1>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home/init.css') }}">
    <div class="row col-lg-12 col-sm-12">
        <div class="form-group col-lg-4 col-sm-12">
            <span>Buscar por n° do pedido</span>
            <input class="form-control" id="search-id">
        </div>
        <div class="form-group col-lg-3 col-sm-12">
            <span>&nbsp;</span>
            <input type="button"  class="form-control btn btn-info" id="clear-filter" value="Limpar filtro">
        </div>
    </div>
{{--    <div class="row col-sm-12 col-lg-12">--}}
{{--        @foreach($sales as $sale)--}}
{{--                <div id="{{ $sale->sale_id }}" class="through-sales card sales col-sm-3 col-lg-3 pt-2">--}}
{{--                    <p>ID : {{ $sale->sale_id }}</p>--}}
{{--                    <p>Data : {{ Carbon\Carbon::parse($sale->created_at)->format('d/m/Y')  }}</p>--}}
{{--                    <p>Produto : {{ $sale->products[0]['name'] }}</p>--}}
{{--                    <p>Quantidade : {{ $sale->amount }} unidades</p>--}}
{{--                    <p>Valor unitário : R$ {{ $sale->products[0]['value'] }}</p>--}}
{{--                    <p>Valor total : R$ {{ floatval($sale->products[0]['value']) * $sale->amount}}</p>--}}
{{--                    <p>Status :--}}
{{--                        <span>@if ( $sale->status == \App\Constants\SalesStatus::EM_ABERTO ) Em aberto @endif</span>--}}
{{--                        <span>@if ($sale->status == \App\Constants\SalesStatus::FINALIZADO) Finalizado @endif</span>--}}
{{--                        <span>@if ($sale->status == \App\Constants\SalesStatus::CANCELADO) Cancelado @endif</span>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--    </div>--}}
    <div class="row col-lg-12 col-sm-12">
        @foreach($sales as $key => $sale)
            <div style="color: deeppink" id="{{ $key }}"  class="through-sales card col-lg-12 col-sm-12 pt-2 pb-2">
                <p>ID : {{ $key }} </p>
                <p>Data : {{ Carbon\Carbon::parse($sale[0]['created_at'])->format('d/m/Y - H:m:s')  }} hrs</p>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne{{$key}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                    Produtos
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne{{$key}}" class="collapse show" aria-labelledby="headingOne{{$key}}" data-parent="#accordionExample">
                            <div class="card-body">
                                @php
                                    $total = 0;
                                @endphp
                                <div class="card pt-2 pl-2">
                                    @foreach($sale as $both)
                                        <p>
                                            Nome:
                                            {{ $both->products[0]['name'] }}
                                        </p>
                                        <p>
                                            Valor unitário:
                                            R${{ $both->products[0]['value']}}
                                        </p>
                                        <p>
                                            Quantidade : {{ $both->amount }}
                                        </p>
                                        <p>
                                            Valor total : R$
                                            @php
                                                $total = $total + (floatval($both->products[0]['value']) * $both->amount) ;
                                            @endphp
                                            {{ floatval($both->products[0]['value']) * $both->amount }}
                                        </p>
                                        <p>
                                            Status :
                                            <span>@if ( $both->status == \App\Constants\SalesStatus::EM_ABERTO ) Em aberto @endif</span>
                                            <span>@if ($both->status == \App\Constants\SalesStatus::FINALIZADO) Finalizado @endif</span>
                                            <span>@if ($both->status == \App\Constants\SalesStatus::CANCELADO) Cancelado @endif</span>
                                                            </p>
                                        <hr>
                                    @endforeach
                                </div>
                                <div class="card pt-2 pl-2">
                                    <p>
                                        <h5>Valor total do pedido :</h5>
                                        <b>R$ {{ $total }}</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        @endforeach
    </div>

@stop

@section('js')
    <script src="{{ asset('js/modules/home/init.js') }}"></script>
@endsection

