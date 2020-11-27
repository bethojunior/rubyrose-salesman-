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
            <span>Buscar por ID</span>
            <input class="form-control" id="search-id">
        </div>
        <div class="form-group col-lg-3 col-sm-12">
            <span>&nbsp;</span>
            <input type="button"  class="form-control btn btn-info" id="clear-filter" value="Limpar filtro">
        </div>
    </div>
    <div class="row col-sm-12 col-lg-12">
    @foreach($sales as $sale)
            <div id="{{ $sale->id }}" class="through-sales card sales col-sm-3 col-lg-3 pt-2">
                <p>ID : {{ $sale->id }}</p>
                <p>Data : {{ Carbon\Carbon::parse($sale->created_at)->format('d/m/Y')  }}</p>
                <p>Produto : {{ $sale->products[0]['name'] }}</p>
                <p>Quantidade : {{ $sale->amount }} unidades</p>
                <p>Status :
                    <span>@if ( $sale->status == \App\Constants\SalesStatus::EM_ABERTO ) Em aberto @endif</span>
                    <span>@if ($sale->status == \App\Constants\SalesStatus::FINALIZADO) Finalizado @endif</span>
                    <span>@if ($sale->status == \App\Constants\SalesStatus::CANCELADO) Cancelado @endif</span>
                </p>
            </div>
        @endforeach
    </div>

@stop

@section('js')
    <script src="{{ asset('js/modules/home/init.js') }}"></script>
@endsection

