@extends('layouts.page')

@section('title', 'Meu histórico')
@section('content_header')
    <div class="center">
        <h1 class="m-0">Meu histórico</h1>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home/init.css') }}">
    <div class="row col-sm-12 col-lg-12">
    @foreach($sales as $sale)
{{--            {{ $sale }}--}}
            <div class="card sales col-sm-3 col-lg-3">
                <p>Data : {{ Carbon\Carbon::parse($sale->created_at)->format('d/m/Y')  }}</p>
                <p>Produto : {{ $sale->products[0]['name'] }}</p>
                <p>Quantidade : {{ $sale->amount }}</p>
                <p>Status :
                    <span>@if ( $sale->status == \App\Constants\SalesStatus::EM_ABERTO ) Em aberto @endif</span>
                    <span>@if ($sale->status == \App\Constants\SalesStatus::FINALIZADO) Finalizado @endif</span>
                </p>
            </div>
        @endforeach
    </div>

@stop

@section('js')
    <script src="{{ asset('js/modules/home/init.js') }}"></script>
@endsection

