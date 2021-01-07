@extends('backend::master')
@section('title_postfix', ' | Edit Receivers')
@section('header') Receivers @stop
@section('subHeader') Edit @endsection

@section('content')
    @php($divClass = 6)
    @php($classPartition = 4)
    {!! Form::model($receiver,['route'=>[$routePrefix.'receivers.update',$receiver->id],"enctype"=>"multipart/form-data"]) !!}
    @method('patch')
    @include('backend::receivers.partials.form',['model'=>$receiver])
    {!! Form::close() !!}
@endsection
