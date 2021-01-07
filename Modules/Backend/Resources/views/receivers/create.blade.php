@extends('backend::master')
@section('title_postfix', ' | Create Receivers')
@section('header') Receivers @stop
@section('subHeader') Create @endsection
@section('content')
    @php($divClass = 6)
    @php($classPartition = 4)
    {!! Form::open(['route'=>$routePrefix.'receivers.store',"enctype"=>"multipart/form-data",'class'=>'form-horizontal']) !!}
    @include('backend::receivers.partials.form')
    {!! Form::close() !!}
@endsection

