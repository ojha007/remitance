@extends('adminlte::page')
@section('title', 'Receivers')
@section('content_header')
    <h1>Add Receiver</h1>
@stop
@section('content')
    @php($classPartition =3)
    {!! Form::open(['route'=>$routePrefix.'receivers.store',"enctype"=>"multipart/form-data"]) !!}
    @include('backend::receivers.partials.form',['divClass'=>'col-md-6'])
    {!! Form::close() !!}

@endsection

