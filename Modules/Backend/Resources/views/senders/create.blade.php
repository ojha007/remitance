@extends('backend::master')
@section('title_postfix', ' | Create Senders')
@section('header') Senders @stop
@section('subHeader') Create @endsection
@section('content')
    @php($divClass = 6)
    @php($classPartition = 4)
    {!! Form::open(['route'=>$routePrefix.'senders.store',"enctype"=>"multipart/form-data",'class'=>'form-horizontal']) !!}
    @include('backend::senders.partials.form')
    {!! Form::close() !!}

@endsection

