@extends('adminlte::page')
@section('title', 'Senders')

@section('content_header')
    <h1>Edit Sender</h1>
@stop
@section('content')
    @php($classPartition =3)
    {!! Form::model($receiver,['route'=>[$routePrefix.'receivers.update',$receiver->id],"enctype"=>"multipart/form-data"]) !!}
    @method('patch')
    @include('backend::receivers.partials.form',['divClass'=>'col-md-6','model'=>$receiver])
    {!! Form::close() !!}
@endsection
