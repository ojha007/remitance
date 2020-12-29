@extends('adminlte::page')
@section('title', 'Senders')

@section('content_header')
    <h1>Edit Sender</h1>
@stop
@section('content')
    @php($classPartition =3)
    {!! Form::model($sender,['route'=>[$routePrefix.'senders.update',$sender->id],"enctype"=>"multipart/form-data"]) !!}
    @method('patch')
    @include('backend::senders.partials.form',['divClass'=>'col-md-6','model'=>$sender])
    {!! Form::close() !!}
@endsection
