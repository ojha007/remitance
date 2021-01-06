@extends('backend::master')

{{--@section('title', 'Rates')--}}
@section('title_postfix', '| Dashboard')
@section('header')
    Dashboard
@stop
@section('subHeader')
    Dashboard
@endsection
@section('breadcrumb')
    {{--    {{ Breadcrumbs::render('roles.index',$routePrefix) }}--}}
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            @foreach($widgets as $key=>$widget)
                @include('backend::dashboard.countWidgetTemplate',['widget'=>$widget])
            @endforeach
        </div>
    </div>
@stop
