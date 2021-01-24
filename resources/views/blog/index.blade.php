@extends('layouts.page')

@section('title', 'Blogs')
@section('content_header')
    <div class="center">
        <h1 class="m-0">Blogs</h1>
    </div>
@stop

@section('content')
    @include('includes.alerts')
    <div class="row">
        @foreach($blogs as $blog)
            <div class="row col-lg-12 col-sm-12">
                <div class="card col-lg-4 col-sm-12 pt-1 pb-1">
                    <h5>
                        <p style="color: hotpink">
                            <b>
                                {{ $blog->title }}
                            </b>
                        </p>
                    </h5>
                    <p style="color: hotpink"> {{ $blog->content }} </p>
                    <img src="{{\App\Constants\ImageConstant::PATH.$blog->image }}">
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('js')
    <script src="{{ asset('js/controllers/TypeProduct/TypeProductController.js') }}"></script>
    <script src="{{ asset('js/modules/products/list.js') }}"></script>
@endsection
