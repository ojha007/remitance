@extends('backend::master')
@section('title_postfix', ' | Edit Sender')
@section('header')
    Sender
@stop
@section('subHeader')
    Edit
@endsection
@section('breadcrumb')
@endsection

@section('content')
    @php($divClass = 6)
    @php($classPartition = 4)
    {!! Form::model($sender,['route'=>[$routePrefix.'senders.update',$sender->id],
        "enctype"=>"multipart/form-data",'class'=>'form-horizontal']) !!}
    @method('patch')
    @include('backend::senders.partials.form',['model'=>$sender])
    {!! Form::close() !!}
@endsection
