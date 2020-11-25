@extends('layouts.page')

@section('title', 'Meu histórico')
@section('content_header')
    <div class="center">
        <h1 class="m-0">Meu histórico</h1>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home/init.css') }}">

@stop

@section('js')
    <script src="{{ asset('js/modules/home/init.js') }}"></script>
@endsection

