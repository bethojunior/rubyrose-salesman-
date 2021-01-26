@extends('layouts.page')

@section('title', 'Meu histórico')
@section('content_header')
    <div class="center">
        <h1 class="m-0">Quem somos</h1>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home/us.css') }}">
    <div class="row col-sm-12">
        <div class="card col-sm-12">
            <p style="color: hotpink; text-align: center" class="pt-1">
                {{ $us[0]['content'] }}
            </p>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/modules/home/init.js') }}"></script>
@endsection

