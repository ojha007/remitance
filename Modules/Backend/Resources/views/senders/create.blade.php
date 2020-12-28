@extends('adminlte::page')
@section('title', 'Senders')

@section('content_header')
    <h1>Add Sender</h1>
@stop
@section('content')
    @php($classPartition =3)
    {!! Form::open(['route'=>$routePrefix.'senders.store',"enctype"=>"multipart/form-data"]) !!}
        @include('backend::senders.partials.form',['divClass'=>'col-md-6'])
    {!! Form::close() !!}

@endsection

