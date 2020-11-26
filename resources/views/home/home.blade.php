@extends('layouts.page')

@section('title', 'Meu histórico')
@section('content_header')
    <div class="center">
        <h1 class="m-0">Meu histórico</h1>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home/init.css') }}">
{{--    {{ $sales }}--}}
    <div class="row col-sm-12 col-lg-12">

        @foreach($sales as $sale)
            <div class="card sales col-sm-3 col-lg-3">
                <b>{{ $sale }}</b>
            </div>
        @endforeach
    </div>

@stop

@section('js')
    <script src="{{ asset('js/modules/home/init.js') }}"></script>
@endsection

