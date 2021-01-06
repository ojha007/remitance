@extends('backend::master')
@section('title_postfix', ' |Senders')
@section('header') Senders @stop
@section('subHeader') Create Sender @endsection
@section('content')
    @php($classPartition =3)
    {!! Form::open(['route'=>$routePrefix.'senders.store',"enctype"=>"multipart/form-data"]) !!}
        @include('backend::senders.partials.form',['divClass'=>'col-md-6'])
    {!! Form::close() !!}

@endsection

