@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        @foreach($widgets as $key=>$widget)
            @include('backend::dashboard.countWidgetTemplate',['widget'=>$widget])
        @endforeach
    </div>
@stop

{{--@section('css')--}}
{{--    --}}{{--    <link rel="stylesheet" href="/css/admin_custom.css" >--}}
{{--@stop--}}

{{--@section('js')--}}
{{--    <script> console.log('Hi!'); </script>--}}
{{--@stop--}}
