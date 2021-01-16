@extends('backend::common.modal',[
            'id'=>$modal,
            'route'=>$routePrefix.'rates.store',
            'title'=>'Create Rate',
            'formClass'=>'form-horizontal bootstrap-modal-form'
        ])
@section('modal_body')
    @include('backend::common.input',['name'=>'date','type'=>'date','is_required'=>true,'defaultValue'=>now()->format('Y-m-d')])
    @include('backend::common.input',['name'=>'customer_rate','type'=>'number','is_required'=>true])
    @include('backend::common.input',['name'=>'agent_rate','type'=>'number','is_required'=>true])
@endsection
