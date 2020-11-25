@extends('layouts.page')

@section('title', 'Dashboard ')
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home/init.css') }}">


@stop

@section('js')
    <script src="{{ asset('js/modules/home/init.js') }}"></script>
@endsection

