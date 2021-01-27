@extends('layouts.page')

@section('title', 'Tipos de produto ')
@section('content_header')
    <div class="center">
        <h1 class="m-0">SAC</h1>
    </div>
@stop

@section('content')
    @include('includes.alerts')
    <h3><a style="color: hotpink" class="center btn btn-default" href="tel:(88)21410541">LIGAR</a> </h3>
@stop

@section('js')
    <script src="{{ asset('js/modules/settings/sac.js') }}"></script>
@endsection

