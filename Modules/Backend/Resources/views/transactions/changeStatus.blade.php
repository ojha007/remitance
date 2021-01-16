@php($button='Change Status')
@php($divClass ='12')
@php($classPartition ='2')
@extends('backend::common.modal',[
            'id'=>'changeStatus',
            'route'=>[$routePrefix.'transactions.changeStatus',$transaction->id],
            'title'=>'Change Status',
            'formClass'=>'form-horizontal bootstrap-modal-form'
        ])
@section('modal_body')
    @include('backend::common.input',['name'=>'status_id','type'=>'select','options'=>$selectStatus,'is_required'=>'true'])
    @include('backend::common.input',['name'=>'notes','type'=>'textarea'])
@endsection
